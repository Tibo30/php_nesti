<?php
class ImportDAO extends ModelDAO
{
    /**
     * get last import of an article
     * int $idArticle
     */
    public function getLastImport($idArticle)
    {
        $req = self::$_bdd->prepare('SELECT * FROM import WHERE id_article=:id ORDER BY import_date DESC LIMIT 1');
        $req->execute(array("id" => $idArticle));
        $importObject = new Import();
        if ($data = $req->fetch()) {
            $importObject->hydration($data);
        }
        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $importObject;
    }

    /**
     * get last import of a user
     * int $idUser
     */
    public function getLastImportUser($idUser)
    {
        $req = self::$_bdd->prepare('SELECT * FROM import WHERE id_admin=:id ORDER BY import_date DESC LIMIT 1');
        $req->execute(array("id" => $idUser));
        $importObject = new Import();
        if ($data = $req->fetch()) {
            $importObject->hydration($data);
        }
        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $importObject;
    }

    /**
     * get all imports
     */
    public function getImports()
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM import');
        $req->execute();
        if ($data = $req->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($data as $row) {
                $import = new Import();
                $import->hydration($row);
                $var[] = $import;
            }
        }
        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $var;
    }

    /**
     * get all imports for a user
     * int $idUser
     */
    public function getImportsUser($idUser)
    {
        $var = [];
        $req = self::$_bdd->prepare('SELECT * FROM import WHERE id_admin=:id ');
        $req->execute(array("id" => $idUser));
        if ($data = $req->fetchAll(PDO::FETCH_ASSOC)) {
            foreach ($data as $row) {
                $import = new Import();
                $import->hydration($row);
                $var[] = $import;
            }
        }
        $req->closeCursor(); // release the server connection so it's possible to do other query
        return $var;
    }
}
