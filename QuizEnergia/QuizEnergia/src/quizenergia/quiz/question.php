<?php

require_once("database.class.php");

class Question
{

    private $id;
    private $question;
    private $user_answer;
    private $admin_answer;

    public function __construct($id = 0, $q, $a_a)
    {
        $this->id = $id;
        $this->question = $q;
        $this->admin_answer = $a_a;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getQuestion()
    {
        return $this->question;
    }
    /**
     * Il metodo serve per aggiornare il database riguardante le risposte dell'utente
     * @$id_question è l'id della domanda a cui corrisponde la risposta dell'utente 
     * 
     */
    public function insertUserAnswerMysql($id_question)
    {
    }
    /**Il metodo servità per controllare le risposte dell'utente */
    public function controlAnswers($user_answer)
    {
    }
    /* public function getAdminAnswer(){
        return $this->admin_answer;
    }
    */
}

class Questions
{
    protected static $instance;
    private $randomQuestions = null;

    protected function __construct()
    {
    }

    public static function getInstance()
    {

        if (empty(self::$instance)) {

            try {
                //$this->score = getScore();
                $dbh = DB::getInstance();
                $stmt = $dbh->prepare("SELECT * FROM question")->execute();
                while ($row = $stmt->fetch()) {
                    self::$instance[] = new Question($row['id'], $row['question'], $row['admin_answer']);
                }
            } catch (PDOException $error) {
                echo $error->getMessage();
            }
        }

        return self::$instance;
    }

    /** Il metodo serve a inserire il voto ricevuto dall'utente */
    public function insertMarkMysql()
    {
    }

    /**
     * Il metodo ritorna il punteggio che l'utente farà se la risposta
     * alla domanda risulterà giusta
     */
    private function getScore()
    {
        return 10 / sizeof(self::$instance);
    }
    /**
     * La funzione serve per generare un numero casuale
     * da 0 a la lunghezza dell'instanza della classe
     */
    public function getRandomIndex()
    {
        return rand(0, sizeof(self::$instance));
    }
    /**
     * La funzione serve a controllare se la domanda è già presente
     * nella lista generata casualmente se si, finisce il ciclo
     * ritornando FALSE in modo da fare capire che l'inserimento non
     * è andato a buon termine, se invece la domanda non è presente 
     * la domanda viene inserita nell'array e viene ritornato TRUE
     */
    public static function controlRandomQuestion($question)
    {
        //controllo se l'array è vuoto, se lo è non controllo niente ed inserisco direttamente la domanda
        if ($this->randomQuestions == null) {
            $this->randomQuestions[] = $question;
        } else {
            for ($i = 0; $i < sizeof($this->randomQuestions); $i++) {
                if (hash_equals($this->randomQuestions[$i], $question)) {
                    return FALSE;
                }
            }
            $this->randomQuestions[] = $question;
            return TRUE;
        }
    }

    public function controlUserAnswer()
    {
        for ($i = 0; $i < sizeof($this->randomQuestions); $i++) {
            $this->randomQuestions[$i]->controlAnswers();
        }
    }
}

class User
{

    private $id = null;
    private $name;
    private $surname;

    public function __construct($nm, $sn)
    {
        $this->name = $nm;
        $this->surname = $sn;
    }

    /**Il metodo serve a inserire l'utente nel database
     * il quale non verrà inserito prima del test
     * ma dopo in quanto solo una volta finita la prova 
     * avremmo tutti i dati a disposizione in modo da non creare dei 
     * vuoti inutili causati da crush dell'applicazione o 
     * da eventuali  problemi di rete 
     */
    public static function insertUser()
    {
        $dbh = DB::getInstance();
        try {
            $dbh->prepare("INSERT INTO user(name,surname) VALUES (" . $this->name . "," . $this->surname . ")")->execute();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }
}
