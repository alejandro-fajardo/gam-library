<?php
function connect()
{
    //Local
    $ms = new mysqli('mysql', 'root', 'root', 'gam');
    $ms->set_charset("utf8");
    return $ms;
}

function query($table,$cols,$where,$print)
{
    $ms = connect();
    $result = array();
    $query="SELECT $cols FROM $table WHERE $where";
    if($print)
    {
        echo $query."<br>";
    }
    $sql = $ms->query($query);
    if($sql)
    {
        while($row = $sql->fetch_array())
        {
            $result[] = $row;
        }
    }  
    $ms->close();
    return $result;  
}

function add($table,$cols,$values,$print)
{
    $ms = connect();
    $query = "INSERT INTO ".$table." (".$cols.")
    VALUES (".$values.")";

    if($print)
    {
        echo $query."<br>";
    }

    $sql = $ms->query($query);
    $ms->close();
    if($sql)
        return true;
    else
        return false;
}

function update($table,$cols,$where,$print)
{
    $ms = connect();
    $query = "UPDATE ".$table." SET ".$cols."
    WHERE ".$where;

    if($print)
    {
        echo $query."<br>";
    }

    $sql = $ms->query($query);
    $ms->close();
    if($sql)
        return true;
    else
        return false;
}

function delete($table,$where,$print)
{
    $ms = connect();
    $query = "DELETE FROM ".$table." WHERE ".$where;

    if($print)
    {
        echo $query."<br>";
    }

    $sql = $ms->query($query);
    $ms->close();
    if($sql)
        return true;
    else
        return false;
}
?>