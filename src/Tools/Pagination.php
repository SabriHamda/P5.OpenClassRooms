<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12.06.18
 * Time: 20:01
 */

namespace src\Tools;
use src\Repository\Model;


class Pagination extends Model
{
    public $id, $title,$image,$content,$content_right,$created_at,$updated_at;
    public $page;
    private $table;
    public $countPages;

    public function __construct()
    {
        if ($this->image) {
            $this->image = urldecode($this->image);
        }
        return null;
    }

    public function run($table, $resultsInPage,$page)
    {
        $this->countPages = $this->countPages($table, $resultsInPage);
        $this->page = $this->getPage($page);
        return $this->table = $this->getTable($table, $resultsInPage);

    }


    private function countPages(string $table, int $resultsInPage)
    {

        //Une connexion SQL doit être ouverte avant cette ligne...
        $connection = $this->getDb()->getConnection();
        $queryString = "SELECT COUNT(*) AS total FROM `$table`";
        $countRows = $connection->prepare($queryString); //Nous récupérons le contenu de la requête dans $countRows
        $countRows->execute();
        $countRows->setFetchMode(\PDO::FETCH_CLASS, self::class);
        $totalData = $countRows->fetch(); //On range retour sous la forme d'un tableau.
        $totalRows = $totalData->total; //On récupère le total pour le placer dans la variable $total.
        //Nous allons maintenant compter le nombre de pages.
        $countPages = ceil($totalRows / $resultsInPage);
        return $countPages;
    }

    private function getPage(int $curentPage)
    {

        if (isset($curentPage) && !empty($curentPage)) // Si la variable $_GET['page'] existe...
        {
            $this->page = intval($curentPage);

            if ($this->page > $this->countPages) // Si la valeur de $this->page (le numéro de la page) est plus grande que $this->countPages...
            {
                $this->page = $this->countPages;
            }
        } else // Sinon
        {
            $this->page = 1; // La page actuelle est la n°1
        }
        return $this->page;
    }

    private function getTable(string $table, int $resultsInPage)
    {

        $firstEntry = ($this->page - 1) * $resultsInPage; // On calcul la première entrée à lire
        // La requête sql pour récupérer les messages de la page actuelle.
        $connection = $this->getDb()->getConnection();
        $queryString = "SELECT * FROM `$table` ORDER BY id DESC LIMIT :firstEntry, :resultsInPage";
        $retour_messages = $connection->prepare($queryString);
        $retour_messages->bindValue(':firstEntry', $firstEntry, \PDO::PARAM_INT);
        $retour_messages->bindValue(':resultsInPage', $resultsInPage, \PDO::PARAM_INT);
        $retour_messages->execute();
        $retour_messages->setFetchMode(\PDO::FETCH_CLASS, self::class);
        return $retour_messages->fetchAll();

    }
}