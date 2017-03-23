<?php

namespace MyApp;

class Quiz {

  private $_quizSet = [];
  private $_db;

  public function __construct()
  {
    Token::create();

    // データベースに接続
    try {
      $this->_db = new \PDO(DSN, DB_USERNAME, DB_PASSWARD);
      $this->_db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      // $_quizSetにデータを挿入
      $this->_setup();
    } catch (\PDOException $e) {
      echo $e->getMessage();
      exit;
    }

    // Session dataの初期化
    if (!isset($_SESSION['current_num'])) {
      $this->_initSession();
    }

  }

  private function _initSession() {
    $_SESSION['current_num'] = 0;
    $_SESSION['current_count'] = 0;
  }

  public function checkAnswer() {
    Token::validate('token');
    $correctAnswer = $this->_quizSet[$_SESSION['current_num']]['a'][0];
    if (!isset($_POST['answer'])) {
      throw new \Exception("answer not set!");
    }
    if ($correctAnswer === $_POST['answer']) {
      $_SESSION['current_count']++;
    }
    $_SESSION['current_num']++;
    return $correctAnswer;
  }

  public function isFinished() {
    return count($this->_quizSet) === $_SESSION['current_num'];
  }

  public function getScore() {
    return round($_SESSION['current_count'] / count($this->_quizSet) * 100);
  }

  public function isLast() {
    return count($this->_quizSet) === $_SESSION['current_num'] + 1;
  }

  public function reset() {
    $this->_initSession();
  }

  public function getCurrentQuiz() {
    return $this->_quizSet[$_SESSION['current_num']];
  }

  // private function _setup() {
  //   $this->_quizSet[] = [
  //     'q' => 'What is A?',
  //     'a' => ['A0', 'A1', 'A2', 'A3']
  //   ];
  //   $this->_quizSet[] = [
  //     'q' => 'What is B?',
  //     'a' => ['B0', 'B1', 'B2', 'B3']
  //   ];
  //   $this->_quizSet[] = [
  //     'q' => 'What is C?',
  //     'a' => ['C0', 'C1', 'C2', 'C3']
  //   ];
  // }

  private function _setup() {

    /*
    $this->_quizSet[] = [
      'q' => 'What is A?',
      'a' => ['A0', 'A1', 'A2', 'A3']
    ];
    $this->_quizSet[] = [
      'q' => 'What is B?',
      'a' => ['B0', 'B1', 'B2', 'B3']
    ];
    $this->_quizSet[] = [
      'q' => 'What is C?',
      'a' => ['C0', 'C1', 'C2', 'C3']
    ];
    */

    /*
    // データの個数を取得
    $sql = "select count(*) from quizzes";
    $stmt = $this->_db->query($sql);
    $count = $stmt->fetchColumn();

    for ($i = 0; $i < $count; $i++) {

      $sql = sprintf("select * from quizzes where id = %d + 1", $i);
      $stmt = $this->_db->query($sql);
      $quiz = $stmt->fetchAll();

      $this->_quizSet[] = [
        'q' => $quiz[0]['question'],
        'a' => [
          $quiz[0]['correct_answer'],
          $quiz[0]['wrong_answer1'],
          $quiz[0]['wrong_answer2'],
          $quiz[0]['wrong_answer3']
        ]
      ];
      */

      // foreachを用いた方法
      $sql = "select * from quizzes";
      $stmt = $this->_db->query($sql);
      $quizzes = $stmt->fetchAll();

      foreach ($quizzes as $quiz) {
        $this->_quizSet[] = [
          'q' => $quiz['question'],
          'a' => [
            $quiz['correct_answer'],
            $quiz['wrong_answer1'],
            $quiz['wrong_answer2'],
            $quiz['wrong_answer3']
          ]
        ];
      }

  }

}
