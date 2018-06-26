<?php
/**
 * Created by Sabri Hamda.
 * Date: 26.06.18
 * Time: 10:43
 */

namespace src\Controllers\Dashboard\Articles;

use src\Repository\ArticleRepository;
use src\Validator\Validator;
use src\Validator\Constraints\IsNotEmpty;
use src\Validator\Constraints\IsInteger;
use src\Tools\UploadFile;
use src\Models\Article;


trait ArticleUpdateController
{
    private $articleId;
    private $articleImage;
    private $articleChapo;
    private $articleTitle;
    private $articleContent;
    private $data;


    public function updateArticle(int $articleId)
    {
        $this->articleId = $articleId;
        $validator = new Validator();
        $entry = blog()->getRequest();
        $updateViolations = $validator->validate($entry->post(), [new IsNotEmpty()]);
        $idViolations = $validator->validate($this->getArticleId(), [new IsNotEmpty(), new IsInteger()]);
        if ($updateViolations && $idViolations) {
            $this->articleTitle = $entry->post('article-title');
            $this->articleContent = $entry->post('article-content');
            $this->articleChapo = $entry->post('article-chapo');
            $this->articleImage = $entry->post('article-image');
            if (empty($articleImage['name'])) {
                $this->hydrateArticle($articleImage['name']);
                $updateArticle = new ArticleRepository();
                $updateArticle->updateArticle($this->data);
                $this->message = $validator->getAlertMessages();
                $this->editArticle($this->getArticleId());
            } else {
                $uploadMyFile = UploadFile::uploadFile('article-image', 'assets/images/uploads/' . $articleImage["name"] . '', FALSE, array('png', 'gif', 'jpg', 'jpeg'));
                if ($uploadMyFile) {
                    $this->editArticle($articleId);
                    $updateArticle = new Articlerepository();
                    $updateArticle->updateArticle($this->data);
                    $this->message = $validator->getAlertMessages();
                    $this->editArticle($this->getArticleId());
                } else {
                    $this->message = ['status' => 'alert-danger', 'message' => "<strong>Erreur ! </strong> Le format de votre image est incorrect"];
                    $this->editArticle($articleId);
                }
            }

        } else {
            $this->message = $validator->getAlertMessages();
            $this->editArticle($articleId);

        }
    }

    /**
     * @param $imageStatus
     */
    private function hydrateArticle($imageStatus)
    {
        if (empty($imageStatus)) {
            $this->data = new Article();
            $this->data->setId($this->getArticleId());
            $this->data->setTitle($this->articleTitle);
            $this->data->setContent($this->articleContent);
            $this->data->setChapo($this->articleChapo);
        } else {
            $this->data = new Article();
            $this->data->setId($this->getArticleId());
            $this->data->setTitle($this->articleTitle);
            $this->data->setImage('/assets/images/uploads/' . $this->articleImage["name"] . '');
            $this->data->setContent($this->articleContent);
            $this->data->setChapo($this->articleChapo);
        }
    }

}