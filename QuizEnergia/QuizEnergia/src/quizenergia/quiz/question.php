<?php

require_once("database.class.php");

class Question {

    private $id;
    private $question;
    private $admin_answer;

    public function __construct($id=0,$q,$a_a) {
        $this->id=$id;
        $this->question=$q;
        $this->admin_answer=$a_a;
    }

    public function getID(){
        return $this->id;
    }

    public function getQuestion(){
        return $this->question;
    }

   /* public function getAdminAnswer(){
        return $this->admin_answer;
    }
    */

}

class Questions{
    protected static $instance;
    private $score=getScore();

	protected function __construct() {}

	public static function getInstance() {

		if(empty(self::$instance)) {
				
			try {
                $dbh=DB::getInstance();
                $stmt = $dbh->prepare("SELECT * FROM question");
                $stmt->execute();
                while($row = $stmt->fetch()){
				    self::$instance[] = new Question($row['id'],$row['question'],$row['admin_answer']);
                }
			} catch(PDOException $error) {
				echo $error->getMessage();
			}

		}

    	return self::$instance;
    }
    /**
     * $marks è una matrice
     * PRIMA RIGA : l'id della domanda
     * SECONDA RIGA : la risposta alla domanda soprastante 
     */
    public static function setMark($id_user=null,$marks=null){
        if($marks!=null && $id_user!=null){
            $dbh=DB::getInstance();
            for($i=0;$i<sizeof($marks);$i++){
                $stmt = $dbh->prepare("INSERT INTO user_answer ");
            }
        }
    }
    /**
     * Il metodo ritorna il punteggio che l'utente farà se la risposta
     * alla domanda risulterà giusta
     */
    private function getScore(){
        $dbh=DB::getInstance();
        $stmt = $dbh->prepare("SELECT COUNT(question) AS TotQuestions FROM question");
        $stmt->execute();
        $row = $stmt->fetch();
        return 10/ $row['TotQuestions'];
    }
/**Il metodo servità per controllare le risposte dell'utente */
    public function controlAnswers(){

    }
    /**
     * Il metodo serve per aggiornare il database riguardante le risposte dell'utente
     * @$id_question è l'id della domanda a cui corrisponde la risposta dell'utente 
     * 
     */
    public function insertUserAnswerMysql($id_question){

    }
/** Il metodo serve a inserire il voto ricevuto dall'utente */
    public function insertMarkMysql(){

    }
    /**Il metodo serve a inserire l'utente nel database
     * il quale non verrà inserito prima del test
     * ma dopo in quanto solo una volta finita la prova 
     * avremmo tutti i dati a disposizione in modo da non creare dei 
     * vuoti inutili causati da crush dell'applicazione o 
     * da eventuali  problemi di rete 
     */
    public function insertUser(){

    }
}

?>