<!DOCTYPE html>
<html>
<head>
<title>CI & VUE</title>
<script src="<?php echo base_url()?>assets/js/vue.min.js"></script>
<script src="<?php echo base_url()?>assets/js/axios.min.js"></script>
</head>
 
<body>
<div id="app">	
	<table>
		<thead><th>IDX</th><th>제목</th><th>내용</th><th>작업</th></thead>
		<tbody>
		<tr v-for="row in rows">
			<td>{{row.idx}}</td>
			<td><a href='#'  @click="clear_all();update_form=true; select_post(row)">{{row.subject}}</a></td>
			<td>{{row.content}}</td>
			<td><button @click="del(row.idx)">삭제</button></td>
		</tr>
		</tbody>
	</table>
 
	<button @click="clear_all(); insert_form= true">글작성</button><br>
	<div v-if="result_msg" @click="result_msg = false">{{result_msg}}</div>
	
	<!--글 작성 폼-->
	<div  v-if="insert_form">
	<h4>메모작성</h4>
		<input type="text" name="subject" v-model="new_post.subject" placeholder="제목"><br>
		<textarea name="content" v-model="new_post.content" placeholder="내용"></textarea><br>
		<button @click="clear_all()">취소</button>
		<button @click="insert">추가</button>
	</div>
	
	<!--글 수정 폼-->
	<div  v-if="update_form">
	<h4>메모수정</h4>
		<input type="text" name="idx" v-model="choose_post.idx" disabled><br>
		<input type="text" name="subject" v-model="choose_post.subject"><br>
		<textarea name="content" v-model="choose_post.content"></textarea><br>
		<button @click="clear_all()">취소</button>
		<button @click="update">수정</button>
	</div>
	
</div>
 
</body>
 
<script language="JavaScript">
let app = new Vue({
	el: '#app',
	data: {
		url:"<?php echo site_url() ?>",
		insert_form: false,
		update_form: false,
		rows:[],
		new_post:{
            subject:'',
            content:''},
		choose_post:{},
		result_msg:''
	},
	created(){
      this.get(); 
    },
	methods:{
        get(){ axios.get(this.url+"/board/get").then(function(response){
                app.get_data(response.data.rows);
            })
        },

		insert(){
			let form_data = app.form_data(app.new_post);
				axios.post(this.url+"/board/insert", form_data).then(function(response){
					if(response.data.msg == 'success'){
						app.result_msg = '새로운 글 : "' + app.new_post.subject + '" 작성!';
						app.clear_all();
						app.get();
					}
				})
        },
		
		update(){
            let form_data = app.form_data(app.choose_post);
				axios.post(this.url+"/board/update", form_data).then(function(response){
                if(response.data.msg == 'success'){
                    app.result_msg = '글 제목 : "' + app.choose_post.subject + '" 수정!';
                    app.clear_all();
					app.get();
                }
               })
        },
		
		del(idx){
			axios.get(this.url+"/board/del/"+idx).then(function(response){
				if(response.data.msg == 'success'){
					app.result_msg = idx + ' 삭제!';
					app.clear_all();
					app.get();
				}
            })
		},
		
		get_data(rows){
            app.rows = rows;
        },
		
		select_post(post){
            app.choose_post = post; 
        },
		
		form_data(obj){
			let form_data = new FormData();
		      for ( let key in obj ) {
		          form_data.append(key, obj[key]);
		      } 
		      return form_data;
		},
		
		clear_all(){
            app.new_post = { 
            subject:'',
            content:'',};
            app.insert_form= false;
			app.update_form= false;
			setTimeout(function(){
				app.result_msg=''
			},2500);
        }
    }
	ALERT('A');
})
</script>
</html>
