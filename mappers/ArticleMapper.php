<?php

namespace app\mappers;

use app\core\Collection;
use app\core\Model;
use app\models\Article;

class UserMapper extends \app\core\Mapper
{

    private ?\PDOStatement $insert;
    private ?\PDOStatement $update;
    private ?\PDOStatement $delete;
    private ?\PDOStatement $select;
    private ?\PDOStatement $selectAll;

    /**
     * @param \PDOStatement|null $insert
     * @param \PDOStatement|null $update
     * @param \PDOStatement|null $delete
     */
    public function __construct()
    {
        parent::__construct();
        $this->insert = $this->getPdo()->prepare(
            "INSERT into articles  ( title, content, user_id)
                    VALUES (:title, :content, :user_id)"
        );
        $this->update = $this->getPdo()->prepare(
            "UPDATE articles 
                  SET title= :title, 
                      content = :content, 
                      user_id = :user_id 
                      WHERE id = :id");
        $this->delete = $this->getPdo()->prepare("DELETE FROM article WHERE id=:id");
        $this->select = $this->getPdo()->prepare("SELECT * FROM article WHERE id = :id");
        $this->selectAll = $this->getPdo()->prepare("SELECT * FROM articles");
    }

    /**
     * @param User $model
     * @return Model
     */
    protected function doInsert(Model $model): Model
    {

        $this->insert->execute([
            ":title" => $model->getTitle(),
            ":content" => $model->getContent(),
            ":user_id" => $model->getUserId()
        ]);
        $id = $this->getPdo()->lastInsertId();
        $model->setId($id);
        return $model;
    }

    protected function doUpdate(Model $model): void
    {
        $this->update->execute([
            ":id" => $model->getId(),
            ":title" => $model->getTitle(),
            ":content" => $model->getContent(),
            ":user_id" => $model->getUser(),
        ]);
    }

    protected function doDelete(Model $model): void
    {
        $this->delete->execute([":id" => $model->getId()]);
    }

    protected function doSelect(int $id): array
    {
      $this->select->execute([":id" => $id]);
      return $this->select->fetch(\PDO::FETCH_NAMED);
    }

    protected function doSelectAll(): array
    {
        $this->selectAll->execute();
        return $this->selectAll->fetchAll();
    }

    function createObject(array $data): Model
    {
        return new Article(
            array_key_exists("id", $data) ? $data["id"] : null,
            $data["title"],
            $data["content"],
            $data["user_id"];
    }

    public function getInstance()
    {
        return $this;
    }
}