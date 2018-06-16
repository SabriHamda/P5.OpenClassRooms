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

    /**
     * @var
     */
    public $page;
    /**
     * @var
     */
    private $table;
    /**
     * @var
     */
    private $countPages;

    /**
     * Pagination constructor.
     */
    public function __construct()
    {
        if ($this->image) {
            $this->image = urldecode($this->image);
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getCountPages()
    {
        return $this->countPages;
    }


    /**
     * @param $table
     * @param $resultsInPage
     * @param $page
     * @return array
     */
    public function run($table, $resultsInPage, $page)
    {
        $this->countPages = $this->countPages($table, $resultsInPage);
        $this->page = $this->getPage($page);
        return $this->table = $this->getTable($table, $resultsInPage);

    }

    /**
     * @param string $table
     * @param int $resultsInPage
     * @return float
     */
    private function countPages(string $table, int $resultsInPage)
    {
        $connection = $this->getDb()->getConnection();
        $queryString = "SELECT COUNT(*) AS total FROM `$table`";
        $countRows = $connection->prepare($queryString);
        $countRows->execute();
        $countRows->setFetchMode(\PDO::FETCH_CLASS, self::class);
        $totalData = $countRows->fetch();
        $totalRows = $totalData->total;
        $countPages = ceil($totalRows / $resultsInPage); /** Count how many pages */
        return $countPages;
    }

    /**
     * @param int $curentPage
     * @return int
     */
    private function getPage(int $curentPage)
    {

        if (isset($curentPage) && !empty($curentPage))
        {
            $this->page = intval($curentPage);

            if ($this->page > $this->countPages)
            {
                $this->page = $this->countPages;
            }
        } else // Sinon
        {

            $this->page = 1; /** The actual page is the n°1 */
        }
        return $this->page;
    }

    /**
     * @param string $table
     * @param int $resultsInPage
     * @return array
     */
    private function getTable(string $table, int $resultsInPage)
    {

        $firstEntry = ($this->page - 1) * $resultsInPage; /** Calculate the first entry to read */

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