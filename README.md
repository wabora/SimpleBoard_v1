# SimpleBoard_v1
CodeIgniter 와 Vue.js 를 사용한 심플게시판 v1 입니다.

CodeIgniter 3.x 를 다운받아 웹호스팅 환경을 준비합니다.

MySQL 데이타베이스 test 에 아래 쿼리로 테이블 생성

CREATE TABLE `board` (`idx` int(10) NOT NULL AUTO_INCREMENT,`subject` varchar(50) NOT NULL,`content` text NOT NULL,PRIMARY KEY(`idx`)) DEFAULT CHARSET=utf8;
1
CREATE TABLE `board` (`idx` int(10) NOT NULL AUTO_INCREMENT,`subject` varchar(50) NOT NULL,`content` text NOT NULL,PRIMARY KEY(`idx`)) DEFAULT CHARSET=utf8;
3) application/config/database.php 파일에 DB 접속정보 기입
4) application/config/config.php 파일에서 base_url 설정
5) application/config/routes.php 파일에서 $route[‘default_controller’] = ‘board/index’;  와 같이 설정
6) application/config/autoload.php 파일에서
$autoload[‘helper’] = array(‘url’); 수정
$autoload[‘libraries’] = array(‘database’); 수정
7) 이 코드는 최상위 디렉토리 CI 입니다.
8) 홈페이지 최상위 디렉토리에 assets/js 디렉토리 생성 후 vue.min.js, axios.min.js 파일 저장합니다.
