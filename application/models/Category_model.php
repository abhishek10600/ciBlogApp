<?php
class Category_model extends CI_model
{
    public function create($formArray)
    {
        $this->db->insert('categories', $formArray);
    }
    public function getCategories($params = [])
    {
        if (!empty($params['queryString'])) {
            $this->db->like('name', $params['queryString']);
        }
        $result = $this->db->get('categories')->result_array();
        return $result;
    }
    public function getCategory($id)
    {
        $this->db->where('id', $id);
        $category = $this->db->get('categories')->row_array();
        return $category;
    }
    public function update($formArray, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('categories', $formArray);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('categories');
    }

    /* Front End */
    public function getCategoriesFront($params = [])
    {
        $this->db->where('categories.status', 1);
        $result = $this->db->get('categories')->result_array();
        return $result;
    }
}
