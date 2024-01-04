<?php
function checkUser($listId): bool
{
     $dbResult = dbQuery("SELECT users.username FROM lists JOIN users ON users.user_id = lists.user_id WHERE lists.list_id = ? LIMIT 1;", [$listId], true);

     if ($dbResult["username"] == $_SESSION["userId"]) return true;
     else return false;
}