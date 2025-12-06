<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Pet Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link href="css/blast.min.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="css/center.css">
</head>

<body>
    <div class="main">
        <div id="page">
            <div id="home" class="banner" data-blast="bgColor">
                <?php
                include 'header.php';
                ?>
            </div>
        </div>
    </div>
    <section class="info-sec parallax-section py-lg-5 py-4" id="book">
        <br>
        <br>
        <div class="xtx_body">
            <div class="wrapper">
                <?php
                include 'aside.php';
                ?>
                <div class="main">
                    <?php
                    include 'top.php';
                    ?>
                    <div class="pannel orders">
                        <div class="pannel_title">
                            <h4>Upload Profile Picture</h4>
                        </div>
                        <div class="modal-body">
                            <form id="uploadAvatarForm" method="post" enctype="multipart/form-data" action="action/upload_avatar.php">
                                <button type="button" class="upload-area" onclick="document.getElementById('avatar').click();">
                                    <span class="upload-area-title">Select the image you want to upload</span>
                                </button>
                                <input type="file" id="avatar" name="avatar" class="upload-input" accept="image/*" onchange="previewImage();" style="display:none;">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn-secondary" onclick="closeModal()">Cancel</button>
                            <button class="btn-primary" id="uploadButton" onclick="submitForm();" disabled>Upload</button>
                        </div>
                    </div>

                    <script>
                        function previewImage() {
                            const fileInput = document.getElementById('avatar');
                            const file = fileInput.files[0];
                            const uploadArea = document.querySelector('.upload-area');
                            const uploadButton = document.getElementById('uploadButton');

                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    uploadArea.innerHTML = `<img src="${e.target.result}" alt="Profile Picture Preview" class="logo-preview-image">`;
                                    uploadButton.disabled = false;
                                };
                                reader.readAsDataURL(file);
                            } else {
                                uploadArea.innerHTML = '<span class="upload-area-icon">Select the image you want to upload</span>'; 
                                uploadButton.disabled = true;
                            }
                        }

                        function submitForm() {
                            document.getElementById('uploadAvatarForm').submit(); 
                        }

                        function closeModal() {
                            location.reload();
                        }
                    </script>

                </div>
            </div>
        </div>
    </section>


    <?php
    include 'footer.php';
    ?>
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/boost.js"></script>
    <script src="js/blast.min.js"></script>
    <script src="js/lightbox-plus-jquery.min.js"></script>
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script src="js/bootstrap.js"></script>
</body>

</html>