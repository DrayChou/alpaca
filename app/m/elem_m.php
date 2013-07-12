<?php

class elem_m extends m
{

    function __construct()
    {
        parent::__construct();
        $this->table = 'elem';
        $this->fields = array('title', 'mod', 'rel_id', 'elem_name', 'elem_info', 'tags',
            'post_time', 'update_time', 'user_id', 'user_name', 'order_by');
    }

    function gname($name, $page_only = false)
    {
        $name = addslashes($name);
        $query = is_numeric($name) ? " and id='$name'" : " and lower(elem_name) = lower('$name')";
        if ($page_only)
            $query .= " and `mod` in ('page','dir')";
        $pages = $this->get($query);
        if (isset($pages[0]))
            return $pages[0];
        return FALSE;
    }

    function updateinfo($id, $arr)
    {
        $r = $this->get($id);
        $info = is_array(_decode($r['elem_info'])) ? array_merge(_decode($r['elem_info']), $arr) : $arr;
        $this->update($id, array('elem_info' => _encode($info)));
    }

    function elem_del($id)
    {
        $e = $this->get($id);
        $this->del($id);
        if ($e['mod'] == 'dir') {
            $es = $this->get(" and rel_id='$id'", 0, 999999);
            if (empty($es))
                return;
            foreach ($es as $e) {
                $this->elem_del($e['id']);
            }
        } else {
            //del tags and comments
            $this->del_by_rel($id);
        }
    }

    function del_by_rel($id, $mod = false)
    {
        $where = $mod ? " and `mod` = '$mod'" : '';
        $es = $this->db->query("delete from elem where rel_id='$id' $where ");
    }

    function tags()
    {
        return $this->db->query("select count(id) as num, title,elem_name from elem where `mod`= 'tag' group by elem_name");
    }

//todo: check if right
    function setting($key = NULL, $val = NULL, $type = 'label')
    {
        if (!isset($this->db))
            return;
        if (!$key) {
            $s = $this->get(" and `mod`='setting' ");
            return _decode($s[0]['elem_info'], true);
        }

        $s = $this->get(" and `mod`='setting' ");
        if (!$s[0]) {
            $this->add(array('mod' => 'setting'));
            $s = $this->get(" and `mod`='setting'");
        }
        $setting = _decode($s[0]['elem_info'], true);
        $key = trim($key);
        if (isset($val)) {
            $setting[$key] = array('val' => $val, 'type' => $type);
        } else {
            $setting = array_diff_key($setting, array($key => ''));
        }
        $this->update($s[0]['id'], array('elem_info' => _encode($setting)));
    }

}

?>