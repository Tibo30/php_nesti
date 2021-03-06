<?php
class Import
{
    private $refOrder;
    private $idAdmin;
    private $importDate;
    private $iDArticle;

    public function hydration($data)
    {
        $this->refOrder = $data['ref_order'];
        $this->idAdmin = $data['id_admin'];
        $this->importDate = $data['import_date'];
        $this->iDArticle = $data['id_article'];
        return $this;
    }

    /**
     * Get the value of refOrder
     */
    public function getRefOrder()
    {
        return $this->refOrder;
    }

    /**
     * Set the value of refOrder
     *
     * @return  self
     */
    public function setRefOrder($refOrder)
    {
        $this->refOrder = $refOrder;

        return $this;
    }

    /**
     * Get the value of idAdmin
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    /**
     * Set the value of idAdmin
     *
     * @return  self
     */
    public function setIdAdmin($idAdmin)
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }

    /**
     * Get the value of importDate
     */
    public function getImportDate()
    {
        return $this->importDate;
    }

    /**
     * Get the display date
     */
    public function getDisplayDate()
    {
        $date = new DateTime($this->importDate);
        $displayDate = "";
        if ($this->importDate!=null){
            $displayDate= $date->format('j F Y \a\t H\hi');
        } 
        return $displayDate;
    }

    /**
     * Set the value of importDate
     *
     * @return  self
     */
    public function setImportDate($importDate)
    {
        $this->importDate = $importDate;

        return $this;
    }

    /**
     * Get the value of iDArticle
     */
    public function getIDArticle()
    {
        return $this->iDArticle;
    }

    /**
     * Set the value of iDArticle
     *
     * @return  self
     */
    public function setIDArticle($iDArticle)
    {
        $this->iDArticle = $iDArticle;

        return $this;
    }

    /**
     * Get the article
     */
    public function getArticle()
    {
        $articleDAO = new ArticleDAO();
        $article = $articleDAO->getArticle($this->iDArticle);
        return $article;
    }

    /**
     * Get lot
     */
    public function getLot()
    {
        $lotDAO = new LotDAO();
        $lot = $lotDAO->getLot($this->iDArticle, $this->refOrder);
        return $lot;
    }
}
