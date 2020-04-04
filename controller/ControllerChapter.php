<?php
namespace P5\Controller;
use P5\Model\ManagementChapter;

    class ControllerChapter{ 

        private $_managementChapter;


        function __construct()
        {
            $this->_managementChapter = new ManagementChapter;

        }

        public function chapterList(){
            $chapters = $this->_managementChapter->chapterLists();
            require('view/viewChapterList.php');

        }

        public function chapterAndComments($idChapter){
            $chapter = $this->_managementChapter->chapter($idChapter);
            $comments = $this->_managementChapter->comments($idChapter);
            $dateChapter = $this->_managementChapter->date('chapters', $idChapter);

            $test = $chapter->rowCount();
            if($test === 0){
                $this->chapterList();
            }else{
                require('view/viewChapterAndComments.php');
            }

        }
        public function addChapter($informationChapter = []){
            require('view/viewAddChapter.php');
        }

        public function registerChapter($chapter_name, $chapter_number, $chapter_content){
            $numberChapterExist = $this->_managementChapter->tryNumberChapter($chapter_number);
            $exist = $numberChapterExist->rowCount();

            if($exist !== 0 ){
                $informationChapter = [
                    "chapter_name"=>$chapter_name,
                    "chapter_content"=>$chapter_content
                ];
                $echecAddChapter = $this->addChapter($informationChapter);
            }else{
                $registerChapter = $this->_managementChapter->registerChapter($chapter_name, $chapter_number, $chapter_content);

                $this->chapterList();
            }
        }

        public function forUpdateChapter($idChapter){
            $controlUpdateChapter = $this->_managementChapter->forUpdateChapter($idChapter);

            $upChapter = $controlUpdateChapter->fetch();
            require('view/viewAddChapter.php');
        }
        public function updateChapter($id, $chapter_name, $chapter_number, $chapter_content){
            $updateChapter = $this->_managementChapter->updateChapter($id, $chapter_name, $chapter_number, $chapter_content);

            $this->chapterList();
        }

        public function deleteChapter($id){
            $deleteChapter = $this->_managementChapter->deleteChapter($id);

            $this->chapterList(0);
        }

        public function addComment($id, $content){
            $addComment = $this->_managementChapter->addComment($id, $content);
            $this->chapterAndComments($id);
        }
        public function reportComment($idComment, $idChapter){
            $reportComment = $this->_managementChapter->reportComment($idComment);

            $this->chapterAndComments($idChapter);
        }
        public function commentsManagement(){
            $comments = $this->_managementChapter->commentsManagement();

            require('view/viewReportComment.php');
        }
        public function acceptComment($idComment){
            $acceptComment = $this->_managementChapter->acceptComment($idComment);

            header('Location: /?type=administration');
        }

        public function deleteComment($idComment){
            $deleteComment = $this->_managementChapter->deleteComment($idComment);

            header('Location: /?type=administration');
        }

        public function administrationPage(){
            $commentsReport = $this->_managementChapter->commentsManagement();
            $chapters = $this->_managementChapter->chapterLists();
            $tenLastComments = $this->_managementChapter->tenLastComments();

            require('view/viewAdministration.php');
        }

    }