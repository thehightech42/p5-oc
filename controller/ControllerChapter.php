<?php
namespace P5\Controller;

use P5\Model\ManagementChapter;
use P5\Gestion\Pagination;
use P5\Gestion\CheckFile;

    class ControllerChapter{ 

        private $_managementChapter;

        function __construct()
        {
            $this->_managementChapter = new ManagementChapter;

        }

        public function chapterList($page = 1){
            $page = intval($page);
            //$chapters = $this->_managementChapter->chapterLists();
            $pagination = new Pagination(3, $this->_managementChapter, $page);
            $chapters = $pagination->chaptersPagination();
            $navPage = $pagination->navPage();
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

        public function registerChapter($chapter_name, $chapter_number, $chapter_content, $chapter_image = 1){
            $informationChapter = [
                "chapter_name"=>$chapter_name,
                "chapter_number"=>$chapter_number,
                "chapter_content"=>$chapter_content
            ];

            $numberChapterExist = $this->_managementChapter->tryNumberChapter($chapter_number);
            $exist = $numberChapterExist->rowCount();

            if($exist !== 0 ){
                unset($informationChapter['chapter_number']);
                $echecAddChapter = $this->addChapter($informationChapter);

            }else{
                if($chapter_image['name'] !== ""){
                    // echo"Img</br>";
                    $checkFile = new CheckFile(".jpg,.jpeg,.png,.gif", 5000000, $chapter_image);
                    $testFile = $checkFile->check();
                    
                    if($testFile === true){
                        // echo "Test ok </br>";
                        $name = $checkFile->uniqueName();
                        $src = "img/img-article/".$name;
                        $displacement = move_uploaded_file($chapter_image['tmp_name'], $src);

                        if($displacement){
                            $registerChapter = $this->_managementChapter->registerChapter($chapter_name, $chapter_number, $chapter_content, $src);
                            $newList = $this->chapterList();
                            // echo "Déplacement </br>";
                            }else{
                                $informationChapter["info_img"] ="Enregistrement du fichier impossible";
                                $echecAddChapter = $this->addChapter($informationChapter);
                            }
                        }else{
                            $informationChapter["info_img"] = $testFile;
                            $echecAddChapter = $this->addChapter($informationChapter);

                        }

                }else{
                    $src = 1;
                    $registerChapter = $this->_managementChapter->registerChapter($chapter_name, $chapter_number, $chapter_content, $src);
                    $newListe = $this->chapterList();
                }

            }

        }

        public function forUpdateChapter($idChapter){
            $controlUpdateChapter = $this->_managementChapter->forUpdateChapter($idChapter);

            $informationChapter = $controlUpdateChapter->fetch();
            require('view/viewAddChapter.php');
        }

        public function updateChapter($id, $chapter_name, $chapter_number, $chapter_content, $chapter_image =0 ,$deleteImg){
            // echo $deleteImg."</br>";
            // var_dump($src)."</br>";
            $informationChapter = [
                "chapter_name"=>$chapter_name,
                "chapter_number"=>$chapter_number,
                "chapter_content"=>$chapter_content
            ];
            var_dump($chapter_image);
            
            $numberChapterExist = $this->_managementChapter->tryNumberChapter($chapter_number);
            $exist = $numberChapterExist->rowCount();
            $reqId = $numberChapterExist->fetch();
            // echo $reqId['id'];
            if($exist !== 0 && $reqId['id'] !== $id){
                unset($informationChapter['chapter_number']);
                $echecAddChapter = $this->addChapter($informationChapter);

            }

            if($deleteImg === "Supprimer" || $chapter_image['name'] == ""){
                // echo "Delete or not img";
                
                $newSrc = "1";
                if($deleteImg === "Supprimer"){
                    $deleteImg = $this->_managementChapter->deleteImg($id, $chapter_name, $chapter_number, $chapter_content, $newSrc);
                    $this->forUpdateChapter($id);
                }else{
                    $updateChapter = $this->_managementChapter->updateChapter($id, $chapter_name, $chapter_number, $chapter_content, $newSrc);
                    $this->chapterList();

                }   
                
            }else{
                // echo "Add img";

                $checkFile = new CheckFile(".jpg,.jpeg,.png,.gif", 5000000, $chapter_image);
                $testFile = $checkFile->check();
                
                if($testFile === true){
                    // echo "Test ok </br>";
                    $name = $checkFile->uniqueName();
                    $src = "img/img-article/".$name;
                    $displacement = move_uploaded_file($chapter_image['tmp_name'], $src);
                
                    if($displacement){
                        $updateChapter = $this->_managementChapter->updateChapter($id, $chapter_name, $chapter_number, $chapter_content, $src);
                        $newList = $this->chapterList();
                        // echo "Déplacement </br>";
                        }else{
                            $informationChapter["info_img"] ="Enregistrement du fichier impossible";
                            $echecUpdateChapter = $this->addChapter($informationChapter);
                        }
                }else{
                    $informationChapter["info_img"] = $testFile;
                    $echecAddChapter = $this->addChapter($informationChapter);
                
                }
            }
        }

        public function deleteChapter($id){
            $deleteChapter = $this->_managementChapter->deleteChapter($id);

            $this->chapterList(1);
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