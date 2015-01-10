<?php

class DB{

    /**
     * экзмепляр соединения с базой данных
     * @var PDO
     */
    private $db;

    /**
     * соединение с базой данных
     */
    public function __construct(){
        try{
            $this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8;', DB_USER, DB_PASSWORD);
        } catch(PDOException $e){
            echo 'Подключение не удалось'.$e->getMessage();
        }
    }

    /**
     * добавляет нового пользователя
     * @param FormData $Data
     * @return bool
     */
    public function addUser(FormData $Data){
        $ins = $this->db->prepare("INSERT INTO users (userName, userEmail, password, id_status, hash) VALUES (:userName, :userEmail, :password, :id_status, :hash)");
        return $ins->execute(array(
            'userName' => $Data->userName, 'userEmail' => $Data->userEmail, 'password' => md5($Data->password), 'id_status' => ID_USER, 'hash' => $Data->hash
        ));
    }

    /**
     * добавляет новую категорию
     * @param FormData $Data
     * @return bool
     */
    public function addCat(FormData $Data){
        $ins = $this->db->prepare("INSERT INTO categories (catName, catText) VALUES (:catName, :catText)");
        return $ins->execute(array(
            'catName' => $Data->catName, 'catText' => $Data->catText
        ));
    }

    /**
     * add new theme
     * @param FormData $Data
     * @return bool
     */
    public function addTheme(FormData $Data){
        $ins = $this->db->prepare("INSERT INTO themes (themeName, themeText, id_cat) VALUES (:themeName, :themeText, :id_cat)");
        return $ins->execute(array(
            'themeName' => $Data->themeName, 'themeText' => $Data->themeText, 'id_cat' => $Data->id_cat
        ));
    }

    /**
     * update пользователя
     * @param FormData $Data
     * @return bool
     */
    public function updateUser(FormData $Data){
        $ins = $this->db->prepare("UPDATE users SET userName=:userName, password=:password, extInfo=:extInfo
                                    WHERE id=:id");
        return $ins->execute(array(
            'id' => $Data->id,'userName' => $Data->userName, 'password' => md5($Data->password), 'extInfo' => $Data->extInfo
        ));

    }

    /**
     * выборка из таблицы по id
     * @param $id
     * @param $table
     * @return bool|mixed
     */
    public function requestSelect($id, $table){
        $sth = $this->db->prepare("SELECT * FROM $table WHERE id=:id");
        $sth->execute(array('id' => $id));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($mas)){
            return $mas;
        } else{
            return false;
        }
    }

    /**
     * выборка из таблицы users по userName
     * @param $userName
     * @return bool|mixed
     */
    public function requestSelectUserName($userName){
		$sth = $this->db->prepare("SELECT * FROM users WHERE userName=:userName");
        $sth->execute(array('userName' => $userName));
		$mas = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($mas)){
            return $mas;
        } else{
            return false;
        }
    }

    /**
     * выборка из таблицы users по userEmail
     * @param $userEmail
     * @return bool|mixed
     */
    public function requestSelectUserEmail($userEmail){
        $sth = $this->db->prepare("SELECT * FROM users WHERE userEmail=:userEmail");
        $sth->execute(array('userEmail' => $userEmail));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($mas)){
            return $mas;
        } else{
            return false;
        }
    }

    /**
     * Выборка из таблицы users по userName и hash
     * @param $userName
     * @param $hash
     * @return bool|mixed
     */
    public function getHashDB($userName, $hash){
        $sth = $this->db->prepare("SELECT * FROM users WHERE userName = :userName AND hash = :hash");
        $sth->execute(array('userName' => $userName, 'hash' => $hash));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($mas)){
            return $mas;
        } else{
            return false;
        }
    }
    /**
     * обновляет hash в таблице users
     * @param $id
     * @return bool
     */
    public function updateHashDB($id){
        $sth = $this->db->prepare("UPDATE users SET hash=:hash WHERE id=:id");
        return $sth->execute(array('hash' => 'actived', 'id' => $id));
    }

    /**
     * выборка по пользователю и паролю
     * @param $userName
     * @param $pass
     * @return bool|mixed
     */
    public function requestSelectUser($userName, $pass){
        $sth = $this->db->prepare("SELECT * FROM users WHERE userName = :userName AND password = :pass");
        $sth->execute(array('userName' => $userName, 'pass' => $pass));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($mas)){
            return $mas;
        } else{
            return false;
        }
    }

    /**
     * выбирает все категории
     * @return array|bool
     */
    public function requestSelectCat(){
        $mas = $this->db->query("SELECT * FROM categories", PDO::FETCH_ASSOC)->fetchAll();
        if(!empty($mas)){
            return $mas;
        } else{
            return false;
        }
    }

    /**

     * выборка из таблицы theme
     * @param
     * @return bool|mixed
     */
    public function requestSelectTheme($catid){
        $sth = $this->db->prepare("SELECT * FROM themes WHERE id_cat=:catid");
        $sth->execute(array('catid' => $catid));
        $mas = $sth->fetchAll(PDO::FETCH_ASSOC);
        if(!empty($mas)){
            return $mas;
        } else{
            return false;
        }
    }

    /**
     * выборка сообщений для отображения в теме
     * @param $UserId
     * @return bool|mixed
     */
    public function requestSelectMessages($themeId){
        $sth = $this->db->query("SELECT * FROM messages WHERE (idtopic=:themeId AND isdeleted=1) ");
        $sth->execute(array('themeId' => $themeId));
        $mas = $sth->fetch(PDO::FETCH_ASSOC);
        if(!empty($mas)){
            return $mas;
        } else {
            return false;
        }
    }

    /**
     * запись сообщения
     * @param FormData $Data
     * @return bool
     */
    public function saveMessage(FormData $Data){
        $ins = $this->db->prepare("INSERT INTO messages (messageText, idtopic, iduser) VALUES (:messageText, :idtopic, :iduser)");
        return $ins->execute(array(
            'messageText' => $Data->messageText,
            'idtopic' => $_GET('themeId'),
            'iduser' => $_GET('userId')
        ));
    }

    /**
     * пометка сообщений как удалённых
     * @param $checkedMessages
     * @return bool
     */
    public function deleteMessage($checkedMessages) {
        $ins = $this->db->prepare("UPDATE messages SET (isdeleted=:isdeleted WHERE id=:id)");
        return $ins->execute(array(
            'isdeleted' => 2,
            'id' => $checkedMessages
        ));
    }
}