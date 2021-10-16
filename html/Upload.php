<?php

namespace HTML;

/**
 * Upload data class descriptors.
 *
 * @class UploadData
 * @file Upload.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class UploadData
{
   /** The uploaded filename.
    * @var string
    */
	public	$filename;
   /** The size of the uploaded file.
    * @var int
    */
	public	$size;
   /** The mime type of the uploaded file.
    * @var string
    */
	public	$mimetype;
   /** The path of the uploaded file.
    * @var string
    */
	public	$temporary;
   /** The error code of the uploaded file.
    * @var string
    */
	public	$error;

	function __construct ( $upload )
	{
		$this->filename = $upload['name'];
		$this->size = $upload['size'];
		$this->mimetype = $upload['type'];
		$this->temporary = $upload['tmp_name'];
		$this->error = $upload['error'];
	}

   /**
    * Tell if the uploaded file is valid.
    *
    * @return boolean   True if their's non error, false otherwise.
    */
	function isValid ()
	{
		return $this->error === 'ok';
	}
}

/**
 * Iterator class.
 *
 * @class Upload
 * @file Upload.php
 * @author guitarneck <guitarneck@free.fr>
 * @since 1.0.0
 * @date may 2021
 */
class Upload
{
	private	$datas;

   /**
    * Constructor.
    *
    * @param string $name  The HTML File type input element name.
    */
	function __construct ( $name )
	{
		$this->datas = $this->extract($this->normalize($name));
	}

   /**
    * Retrieve the datas of a single file.
    *
    * @return UploadData   The datas file.
    */
	public
	function file ()
	{
		return $this->datas[0];
	}

   /**
    * Retrieve each datas. Generator.
    *
    * @return UploadData   The datas file.
    */
	public
	function files ()
	{
		foreach ($this->datas as $data) yield $data;
	}

	private
   function normalize ( $name )
   {
      return str_replace('[]', '', trim($name));
   }

	private
	function extract ( $name )
	{
		$upload = $_FILES[$name];

		$result = array();
		foreach ($upload as $k1 => $v1)
			if ( is_array($v1) )
				foreach ($v1 as $k2 => $v2) $result[$k2][$k1] = $v2;
			else
				$result[0][$k1] = $v1;

		array_walk($result, function(&$item){
			$item['error'] = $this->message($item['error']);
			$item = new UploadData($item);
		});

		return $result;
  	}

	private
	function message ( $code )
	{
		switch ($code)
		{
			case UPLOAD_ERR_OK:
				$message = 'ok';
				break;
			case UPLOAD_ERR_INI_SIZE:
				$message = 'The uploaded file exceeds the upload_max_filesize directive';
				break;
			case UPLOAD_ERR_FORM_SIZE:
				$message = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case UPLOAD_ERR_PARTIAL:
				$message = 'The uploaded file was only partially uploaded';
				break;
			case UPLOAD_ERR_NO_FILE:
				$message = 'No file was uploaded';
				break;
			case UPLOAD_ERR_NO_TMP_DIR:
				$message = 'Missing a temporary folder';
				break;
			case UPLOAD_ERR_CANT_WRITE:
				$message = 'Failed to write file to disk';
				break;
			case UPLOAD_ERR_EXTENSION:
				$message = 'An extension stopped the file upload';
				break;

			default:
				$message = 'Unknown error code';
				break;
		}
		return $message;
	}
}
