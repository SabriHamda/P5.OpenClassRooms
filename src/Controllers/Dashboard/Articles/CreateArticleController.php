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
use src\Tools\UploadFile;
use src\Models\Article;


trait CreateArticleController
{
    private $articleId;
    private $articleImage;
    private $articleChapo;
    private $articleTitle;
    private $articleContent;
    private $data;

    public function createArticleIndex()
    {
        echo $this->render('createArticleView.twig', [
            'article' => $this->article,
            'user' => $this->user,
            'uri' => $this->uri,
            'message' => $this->getMessage()
        ]);

    }

    public function addArticle()
    {
        $validator = new Validator();
        $entry = blog()->getRequest();
        $updateViolations = $validator->validate($entry->post(), [new IsNotEmpty()]);
        if ($updateViolations) {
            $this->articleTitle = $entry->post('article-title');
            $this->articleContent = $entry->post('article-content');
            $this->articleChapo = $entry->post('article-chapo');
            $this->articleImage = $_FILES['article-image'];
            if (empty($this->articleImage['name'])) {
                $this->hydrateCreateArticle($this->articleImage['name']);
            }
            $uploadMyFile = UploadFile::uploadFile('article-image', 'assets/images/uploads/' . $this->articleImage["name"] . '', FALSE, array('png', 'gif', 'jpg', 'jpeg'));
            if ($uploadMyFile) {
                $this->hydrateCreateArticle($this->articleImage['name']);
                $updateArticle = new ArticleRepository();
                $updateArticle->addArticle($this->data);
                $this->setMessage($validator->getAlertMessages());
                $this->getRequest()->redirect('/dashboard');
            } else {
                $this->message = ['status' => 'alert-danger', 'message' => '<strong>Erreur ! </strong> Le format de votre image est incorrect'];
                $this->createArticleIndex();
            }


        } else {
            $this->setMessage($validator->getAlertMessages());
            $this->createArticleIndex();

        }
    }

    /**
     * @param $imageStatus
     */
    private function hydrateCreateArticle($imageStatus)
    {
        if (empty($imageStatus)) {
            $this->setMessage(['status' => 'alert-danger', 'message' => '<strong>Erreur ! </strong> Veuillez selectionner une image']);
            $this->createArticleIndex();
        } else {
            $this->data = new Article();
            $this->data->setTitle($this->articleTitle);
            $this->data->setImage('/assets/images/uploads/' . $this->articleImage["name"] . '');
            $this->data->setContent($this->articleContent);
            $this->data->setChapo($this->articleChapo);
        }
    }

}