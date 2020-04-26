<?php

namespace frontend\controllers;

use frontend\controllers\behaviors\AccessBehavior;
use frontend\models\Notebook;
use Yii;

class NotebookController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            AccessBehavior::className(),
        ];
    }

    public function actionCreate()
    {
        $this->checkAccessOnlyAuthUser();

        $notebook = new Notebook();

        if ($notebook->load(Yii::$app->request->post())) {
            $notebook->user_id = Yii::$app->user->id;
            if ($notebook->save()) {
                Yii::$app->session->setFlash('success', 'Запись добавлена.');
                Yii::$app->cache->delete($notebook->cacheUserNotesKey);
                return $this->redirect(['notebook/index']);
            } else {
                Yii::$app->session->setFlash('danger', 'Произошла ошибка!');
            }
        }
        return $this->render('create', compact('notebook'));
    }

    public function actionDelete($id)
    {
        $this->checkAccessOnlyAuthUser();
        $id = (int) $id;
        if ($id > 0) {
            $note = Notebook::findOne($id);
            if ($note->delete()) {
                Yii::$app->session->setFlash('success', 'Запись удалена.');
                Yii::$app->cache->delete($note->cacheUserNotesKey);
            }
        } else {
            Yii::$app->session->setFlash('danger', 'Произошла ошибка, запись не удалена!');
        }
        return $this->redirect(['notebook/index']);
    }

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->render('guestIndex');
        }
        $notebook = new Notebook();
        $notes = $notebook->getUserNotes();
        return $this->render('index', compact('notes', 'notebook'));
    }

    public function actionUpdate($id)
    {
        $this->checkAccessOnlyAuthUser();
        $id = (int) $id;
        if ($id > 0) {
            $note = Notebook::findOne($id);

            if ($note->load(Yii::$app->request->post())) {
                if ($note->save()) {
                    Yii::$app->session->setFlash('success', 'Запись изменена.');
                    Yii::$app->cache->delete($note->cacheUserNotesKey);
                    return $this->redirect(['notebook/index']);
                } else {
                    Yii::$app->session->setFlash('danger', 'Произошла ошибка!');
                }
            }
        } else {
            return $this->render('error');
        }

        return $this->render('update', compact('note'));
    }

}
