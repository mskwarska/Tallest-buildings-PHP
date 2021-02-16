<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
function PokazPodstrone($id)
{
    include 'cfg.php';

    $id_clear = htmlspecialchars($id);

    $query = "SELECT * FROM page_list WHERE id='$id_clear' LIMIT 1";
    $result = $link->query($query);
    $row = $result->fetch_assoc();

    $page = [
        "page_title" => $row["page_title"],
        "page_content" => $row["page_content"],
    ];

    return $page;
}
?>