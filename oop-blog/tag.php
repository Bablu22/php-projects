<?php

class Tag
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllTags()
    {
        $sql = "SELECT * FROM tags";
        return mysqli_query($this->db, $sql);
    }
}

