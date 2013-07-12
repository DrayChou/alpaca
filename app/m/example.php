<?

class example_m extends m
{

// 模块中类的命名必须为 文件名加 _m 结尾
    function __construct()
    {
        parent::__construct();
        $this->table = 'example';
        // 模块调用的表名
        $this->fields = array('title');
        // 表中的字段, id 是每张表的必要字段，但不需要出现在此数组中
    }

// 模块默认继承了父类的 get  add edit del 方法 ，如果还需要定义其他方法可以添加在这里
}
