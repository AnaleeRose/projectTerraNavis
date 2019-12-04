<?php
    abstract class FilesystemRegexFilter extends RecursiveRegexIterator {
        protected $regex;
        public function __construct(RecursiveIterator $iterate, $regex) {
            $this->regex = $regex;
            parent::__construct($iterate, $regex);
        }
    }

    class FilenameFilter extends FilesystemRegexFilter {
        public function accept() {
            return (! $this->isFile() || preg_match($this->regex, $this->getFilename()));
        }
    }

    class DirnameFilter extends FilesystemRegexFilter {
        public function accept() {
            return (! $this->isDir() || preg_match($this->regex, $this->getFilename()));
        }
    }

    $directory = new RecursiveDirectoryIterator('./assets/imgs/article_imgs');
    $filter = new DirnameFilter($directory, '/^(?!\.Trash)/'); 
    $filter = new FilenameFilter($filter, '/^(?:' . $complete_filename . ')$/');
    foreach (new RecursiveIteratorIterator($filter) as $file) {
        if (preg_match('/\.(?:gif|png|jpg|jpeg)$/i', $file)) {
            $img_location = $file;
        }
    }

    if (empty($img_location)) $img_errors[] = 'Could not upload image. Please contact our service team.';