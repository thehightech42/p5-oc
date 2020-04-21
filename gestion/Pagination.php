<?php
namespace P5\Gestion;

class Pagination 
{
    private $_currentPage;
    private $_nbPerPage;  
    private $_table;
    
    private $_nbElements; 
    private $_nbPages;
    private $_offset ;

    /**
     * $nbElements :number
     * $model it's an objet model with two method  :
     *      2. nbElements | $nb = $this->_bd->query("SELECT COUNT(id) FROM chapters")->fetch(\PDO::FETCH_NUM)[0];
     *      1. elementsPagniation | $elements = $this->_bd->query("SELECT * FROM yourTable ORDER BY nameColone LIMIT $nbPerPage OFFSET $offSet");
     * 
     * $currentPage = :number / Desired page number = 1 if it's undifined
     */
    function __construct($nbPerPage, $model, $currentPage)
    {
        $this->_currentPage = $currentPage;
        $this->_nbPerPage = $nbPerPage;
        $this->_model = $model;

        // $this->_bd = $this->AccesBDD();
        $this->nbElements(); 
        $this->nbPages($this->_nbElements, $this->_nbPerPage);
        $this->offset ($this->_currentPage,  $this->_nbPerPage);
        if($this->_currentPage > $this->_nbPages)
        {
            throw new \Exception ("Erreur 404 - Page not found");
        }

    }
    private function nbElements(){   
        $nbElements = $this->_model->nbElements();
        $this->_nbElements = $nbElements;
    }
    private function nbPages($nbElements, $nbPerPage)
    {
        $this->_nbPages = ceil($nbElements / $nbPerPage);
        //echo $this->_nbPages;
    }

    private function offset ($currentPage, $nbPerPage)
    {
        $this->_offset  = $nbPerPage * ($currentPage-1);
    }

    public function chaptersPagination(){
        $elements = $this->_model->elementsPagination($this->_nbPerPage, $this->_offset);
        return $elements;
    }

    public function navPage()
    {
        ob_start();
        ?>
        <div class="col-lg-12 bg-light align-items-center p-2" >
            <ul class="d-flex justify-content-between align-items-center p-0 mb-0">
                <?php
                    if($this->_currentPage > 1){
                        ?>
                        <div class="col-xs-2 smart">
                            <button type="button" class="btn btn-info"><a href="/?type=chapter&action=chapterList&page=<?= $this->_currentPage-1 ?>" class="nav-item nav-link text-white">Page Précédante</a></button>
                        </div>
                        <?php
                    }
                ?>
                
                <div class="col-xs-8 w-100 d-flex justify-content-center">
                    <?php
                    for($i = 1; $i <= $this->_nbPages; $i++)
                    {
                    ?> 
                        <ol class="<?php if($i == $this->_currentPage){?>active <?php };?>">
                            <button type="button" class="btn btn-info mr-1">
                            <a href="/?type=chapter&action=chapterList&page=<?= $i ?>" class="nav-item nav-link<?php if($i == $this->_currentPage){ ?> text-dark <?php }else{ ?> text-white <?php };?>"><?=$i?></a>
                            </button>
                        </ol>
                    <?php
                    }
                    ?>
                </div>
                    <?php
                        if($this->_currentPage  < $this->_nbPages){
                            ?>
                            <div class="col-xs-2 smart">
                                <button type="button" class="btn btn-info"><a href="/?type=chapter&action=chapterList&page=<?= $this->_currentPage+1 ?>" class="nav-item nav-link text-white">Page Suivante</a></button>
                            </div>
                            <?php
                        }
                    ?>
            </ul>  
        </div>

        <?php
        $navPage = ob_get_clean();
        return $navPage;
    }
}