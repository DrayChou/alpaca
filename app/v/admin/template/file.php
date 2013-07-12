<a href="../">返回</a>
<form method="POST">
    模板名称:<input type="input" name="name" value="<?= $name ?>"/>
    <textarea class="code" name="code"><?= str_replace('</textarea>', '< /textarea>', $content) ?></textarea>
    <input type="submit" value="保存修改"/>
</form>
