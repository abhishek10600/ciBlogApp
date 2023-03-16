<?php
class Article_model extends CI_Model
{
    public function getArticle($id)
    {
        $this->db->select('articles.*, categories.name as category_name');
        $this->db->where('articles.id', $id);

        $this->db->join('categories', 'categories.id = articles.category', 'left');

        $article = $this->db->get('articles')->row_array();
        return $article;
    }
    public function getArticles($param = [])
    {
        if (isset($param['offset']) && isset($param['limit'])) {
            $this->db->limit($param['offset'], $param['limit']);
        }
        if (!empty($param['queryString'])) {
            $this->db->or_like('title', trim($param['queryString']));
            $this->db->or_like('author', trim($param['queryString']));
        }
        $query = $this->db->get('articles');
        $result = $query->result_array();
        return $result;
    }
    
    public function getArticlesCount($param = array())
    {
        if (!empty($param['queryString'])) {
            $this->db->or_like('title', trim($param['queryString']));
            $this->db->or_like('author', trim($param['queryString']));
        }

        if(isset($param['category_id'])){
            $this->db->where('category',$param['category_id']);
        }

        $count = $this->db->count_all_results('articles');
        return $count;
    }
    
    public function addArticle($formArray) //This method will save article in DB 
    {
        $this->db->insert('articles', $formArray);
        return $this->db->insert_id();
    }
    
    public function updateArticle($formArray, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('articles', $formArray);
    }
    
    public function deleteArticle($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('articles');
    }

    /* Front-End */

    public function getArticlesFront($param = [])
    {
        if (isset($param['offset']) && isset($param['limit'])) {
            $this->db->limit($param['offset'], $param['limit']);
        }
        if (!empty($param['queryString'])) {
            $this->db->or_like('title', trim($param['queryString']));
            $this->db->or_like('author', trim($param['queryString']));
        }

        if(isset($param['category_id'])){
            $this->db->where('category',$param['category_id']);
        }

        $this->db->select('articles.*,categories.name as category_name');
        $this->db->where('articles.status', 1);
        $this->db->order_by('articles.created_at', 'DESC');

        $this->db->join('categories', 'categories.id=articles.category', 'left');
        //SELECT 'articles'.*,categories.name AS 'category_name' FROM 'articles' LEFT JOIN 'categories' ON 'categories.id' = 'articles.category' ORDER BY 'articles'.'created_at' DESC;

        $query = $this->db->get('articles');
        $result = $query->result_array();
        return $result;
    }
}