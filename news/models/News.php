<?php

/**
* This is the model class for table "blog".
*
* The followings are the available columns in table 'blog':
* @property integer $id
* @property string $pr_title
* @property string $pr_desc
* @property integer $pr_status
*/
class News extends CActiveRecord
{
    /**
    * Returns the static model of the specified AR class.
    * @param string $className active record class name.
    * @return blog the static model class
    */



    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
    * @return string the associated database table name
    */
    public function tableName()
    {
        return 'news';
    }

    /**
    * @return array validation rules for model attributes.
    */
    public function rules()
    {
        // NOTE: you `should only define rules for those attributes that
        // will receive user inputs.
        return array(
        array('news_title, news_desc, news_status,postby', 'required'),
        array('news_status', 'numerical', 'integerOnly'=>true),
        array('news_title', 'length', 'max'=>100),
        // The following rule is used by search().
        // Please remove those attributes that should not be searched.
        array(' news_title, postby, news_date', 'safe', 'on'=>'search'),
        );
    }

    /**
    * @return array relational rules.
    */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(  
        //'user_details'=>array(self::BELONGS_TO, 'Usertable1', 'user_id'),
        );
    }

    /**
    * @return array customized attribute labels (name=>label)
    */
    public function attributeLabels()
    {
        return array(

        );
    }

    /**
    * Retrieves a list of models based on the current search/filter conditions.
    * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
    */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;
        // $criteria->order = 'id DESC';      
        //$criteria->condition="pr_module='Blog'";

        $criteria->compare('id',$this->id);
        $criteria->compare('news_title',$this->news_title,true);
        $criteria->compare('news_desc',$this->news_desc,true);
        //  $criteria->compare('pr_status',$this->pr_status);
        $criteria->compare('news_date',$this->news_date);
        $criteria->compare('postby',$this->postby,true);
        //$criteria->compare('priority',$this->priority,true);

        return new CActiveDataProvider($this, array(
        'criteria'=>$criteria,
        ));
    }



    public function insertdata()
    {




        //$this->postby = $_POST['Blog']['postby'];

        $this->news_date = date('m/d/Y');


        //$this->pr_module = 'Blog';

        $r=$this->save();

        return $this->id;
    }

    public function deletefun($id)
    {
        $this->deleteByPk($id);
    }


    public function updatestatus($id)
    {
         $i=$id;
        $tablename=$this->tableName();
        $pk='id';
        $attribute='news_status';
        $command=  yii::app()->db->createCommand('call common2("'.$tablename.'","'.$attribute.'","'.$pk.'",'.$id.')');
        $command->execute();
    }

    public function updatestatus1($id)
    {
        $i=$id;
        $tablename=$this->tableName();
        $pk='id';
        $attribute='enablecom';
        $command=  yii::app()->db->createCommand('call common2("'.$tablename.'","'.$attribute.'","'.$pk.'",'.$id.')');
        $command->execute();
    }




    public function updatedata($post)
    {
        $this->updateByPk($post['pk'], array($post['name']=>$post['value']));
    }

    public function fetchdata($id)
    {
        $res=$this->findAllByPk($id);
        return $res; 
    }
    public function fetch()
    {

        $condition = 'pr_status = 1';
        $limit = 10;
        $criteria = new CDbCriteria(array(
        'condition' => $condition,
        'order' => 'priority DESC',
        'limit' => $limit,
        //'offset' => $totalItems - $limit // if offset less, thah 0 - it starts from the beginning
    ));
        $res=$this->findAll($criteria);
        return $res; 
    }

    public function fetchupdatedetails($id)
    {
        $res=$this->findByPk($id);
        return $res;  
    }
    public function updatedetails($id,$arr)
    {
        $res=$this->updateByPk($id,$arr);

    }

    public function displaycontent($id)
    {
        $conn = yii::app()->db;
        $sql="select pr_desc from pressrelease where id =".$id;
        $result=$conn->createCommand($sql);
        $result=$result->queryAll();    // for select we will have to use queryAll(), but for update delete insert we will have to use execute. 
        return $result;
    }


    public function fetchdate()
    {
        $conn = yii::app()->db;
        $sql="select news_date from  news";
        $result=$conn->createCommand($sql);
        $result=$result->queryAll();    // for select we will have to use queryAll(), but for update delete insert we will have to use execute. 
        return $result;
    }


    public function fetchcontent($id)
    {
        $conn = yii::app()->db;
        $sql="select news_desc from  news where id=".$id;
        $result=$conn->createCommand($sql);
        $result=$result->queryAll();    // for select we will have to use queryAll(), but for update delete insert we will have to use execute(). 
        return $result;

    }

    public function userImagePath($data){
        if(!empty($data)){ 
            $thumb_path=Yii::app()->request->getBaseUrl(true).'/uploads/proimage/thumb/'.$data;
        }
        else{
            $thumb_path=Yii::app()->request->getBaseUrl(true).'/uploads/default.jpg';
        }
        return($thumb_path); 
    }

}
