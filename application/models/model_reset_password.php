<?php

class model_reset_password extends model
{
    function change_password($new_pass, $id)
	{
		$this->perfom_query("UPDATE users SET password=? WHERE id=?", array(md5($new_pass), $id));
    }

    function get_user_from_link($link)
    {
        $stmt = $this->perfom_query("SELECT * FROM links WHERE link=? AND reason='reset'", array($link));
        $fetch = $stmt->fetchall();
        if (count($fetch) === 0)
            return false;
        $id = $fetch[0]['user_id'];
        return $id;
    }

    function delete_link($link)
    {
        $this->perfom_query("DELETE FROM links WHERE link=?", array($link));
    }
}
?>