<?php


namespace clinela\utils;


class Upload
{
    public $uploadDir;
    public $uploadStatus = 1;
    public $imageFileType;
    public $fileSize;
    public $fileName;
    public $tmpName;
    public $files;

    /**
     * upload constructor.
     *
     * @param $uploadDir
     * @param $files
     */
    public function __construct( $uploadDir, $files ) {
        $this->setUploadDir( ! is_null( $uploadDir ) ? $uploadDir : DOCUMENT_PATH. 'uploads/' );
        $this->files        = $files;
        $this->uploadStatus = Array();
        if ( ! is_null( $files ) ) {
            $this->setFileName( $files['name'] );
            $this->setFileSize( $files['size'] );
            $this->setTmpName( $files['tmp_name'] );
            $this->uploadStatus['error'] = false;
        } else {
            $this->uploadStatus['error'] = true;
        }

    }


    /**
     * @return mixed
     */
    public function getUploadDir() {
        return $this->uploadDir;
    }

    /**
     * @param mixed $uploadDir
     */
    public function setUploadDir( $uploadDir ) {
        $this->uploadDir = $uploadDir;
    }

    /**
     * @return mixed
     */
    public function getUploadStatus() {
        return $this->uploadStatus;
    }

    /**
     * @param mixed $uploadStatus
     */
    public function setUploadStatus( $uploadStatus ) {
        $this->uploadStatus = $uploadStatus;
    }

    /**
     * @return mixed
     */
    public function getImageFileType() {
        return $this->imageFileType;
    }

    /**
     * @return mixed
     */
    public function getFiles() {
        return $this->files;
    }

    /**
     * @param mixed $files
     */
    public function setFiles( $files ) {
        $this->files = $files;
    }

    /**
     * @return mixed
     */
    public function getFileName() {
        return $this->fileName;
    }

    /**
     * @param mixed $fileName
     */
    public function setFileName( $fileName ) {
        $this->fileName = $fileName;
    }


    /**
     * @param mixed $imageFileType
     */
    public function setImageFileType( $imageFileType ) {
        $this->imageFileType = $imageFileType;
    }

    /**
     * @return mixed
     */
    public function getFileSize() {
        return $this->fileSize;
    }

    /**
     * @param mixed $fileSize
     */
    public function setFileSize( $fileSize ) {
        $this->fileSize = $fileSize;
    }


    public function checkFakeImage() {
        $check = getimagesize( $this->getTmpName() );
        if ( $check !== false ) {
            $this->setImageFileType( $check["mime"] );
            $this->uploadStatus['error'] = false;
            $this->uploadStatus['mime']  = $check["mime"];

            return true;
        } else {
            $this->setImageFileType( null );
            $this->uploadStatus['error'] = true;

            return false;
        }
    }

    /**
     * @return mixed
     */
    public function getTmpName() {
        return $this->tmpName;
    }

    /**
     * @param mixed $tmpName
     */
    public function setTmpName( $tmpName ) {
        $this->tmpName = $tmpName;
    }


    /**
     * @param $imageFileType
     *
     * @return bool
     */
    public function isAllowedFormats( $imageFileType ) {
        if ( $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "doc"
            && $imageFileType != "docx" && $imageFileType != "xls" && $imageFileType != "xlsx"
            && $imageFileType != "ppt" && $imageFileType != "pptx" ) {
            $this->uploadStatus['error'] = true;
            $this->uploadStatus['msg']   = "Sorry, only pictures and document files are allowed.";
            $this->setUploadStatus( 0 );

            return false;
        }
    }


    public function startUpload() {
        $target_dir    = $this->getUploadDir();
        $target_file   = $target_dir . $this->getFileName();
        $imageFileType = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION ) );
        // Check if image file is a actual image or fake image
        //$this->checkFakeImage();

// Check if file already exists
        if ( file_exists( $target_file ) ) {
            $this->uploadStatus['name'] = $this->getFileName();
            $this->uploadStatus['size'] = $this->getFileSize();
            $this->uploadStatus['msg']  = "Sorry, file already exists.";
            $uploadOk                   = 0;
        }
// Check file size
        if ( $this->getFileSize() > 5000000 ) {
            $this->uploadStatus['error'] = true;
            $this->uploadStatus['msg']   = "Sorry, your file is too large";
        }
// Allow certain file formats
        $this->isAllowedFormats( $imageFileType );
// Check if $uploadOk is set to 0 by an error
        if ( $this->uploadStatus['error'] == true ) {
            $this->uploadStatus['code'] = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {
            if ( $this->getUploadStatus() != 0 ) {
                if ( move_uploaded_file( $this->getTmpName(), $target_file ) ) {
                    $this->uploadStatus['name'] = $this->getFileName();
                    $this->uploadStatus['size'] = $this->getFileSize();
                }
            }
        }

        return $this->uploadStatus;
    }
}