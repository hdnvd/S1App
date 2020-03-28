<!DOCTYPE HTML>
<html lang="fa">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php $_GET['category']=12;  ?>
    <?php require_once(THEMEPATH . "pagehead.php"); ?>
    <title>شهرستان ویژه مراغه-اخبار، تصاویر و مناطق گردشگری شهر مراغه</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="maragheh,مراغه,اخبار مراغه,مراغا,maragha,خبرهای مراغه,نادر ابراهیمی,تبلیغات در مراغه" />
    <meta name="description" content="تنها وب سایت جامع اخبار،تصاویر و مکان های توریستی شهرستان ویژه مراغه" />
</head>
<body>
<div id="pagecontainer">
    <div id="pagehead">
        <div id="pagetitle">وب سایت جامع شهرستان ویژه مراغه</div>
    </div>
    <?php require_once(THEMEPATH . "topmenu.php"); ?>
    <div id="pagemiddle">
        <?php require_once(THEMEPATH . "rightsidebar.php"); ?>
        <div id="midbar">
            <div id="latestnews"></div>
            <div id="content">
                <?php echo $SWT_FORMLOADER->getResponse(); ?>
            </div>
        </div>
        <?php require_once(THEMEPATH . "leftsidebar.php"); ?>

    </div>

    <?php require_once(THEMEPATH . "footer.php"); ?>
</div>
</body>
</html>
