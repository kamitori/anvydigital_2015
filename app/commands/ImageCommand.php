<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
class ImageCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'image:process';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Image command.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->path 	= $this->option('path');
		$this->name 	= $this->option('name');
		$this->width 	= $this->option('width');
		$this->type 	= $this->option('type');
		switch ($this->type) {
			case 'resize':
				$this->resize();
				break;
			case 'thumb':
				$this->makeThumb();
				break;
			case 'thumbs':
				$this->makeThumbNormal();
				break;
			case 'reset_thumb':
				$this->resetThumb();
				break;
			default:
				$this->makeThumb();
				break;
		}
	}

	private function resize()
	{
		if( is_null($this->path) ) {
			return $this->error('Image\'s path cannot be blank.');
		}
		if( is_null($this->name) ) {
			return $this->error('Image\'s name cannot be blank.');
		}
		$image = Image::make($this->path.DS.$this->name);
		if( $image->width() > $this->width ) {
		    $image->resize($this->width, null, function($constraint){
		        $constraint->aspectRatio();
		    });
		    $image->save($this->path.DS.$this->name);
		}
	}

	private function makeThumb()
	{
		$w=250; $h=184;
		if( is_null($this->path) ) {
			return $this->error('Image\'s path cannot be blank.');
		}
		if( is_null($this->name) ) {
			return $this->error('Image\'s name cannot be blank.');
		}
		$image = Image::make($this->path.DS.$this->name);
		$ratio_thumbs = $w/$h;
		$ratio_img = $image->width()/$image->height();
		if($ratio_img<$ratio_thumbs){
			$image->resize($w, null, function($constraint){
		        $constraint->aspectRatio();
		    });
		    
		}else{
			$image->resize( null,$h, function($constraint){
		        $constraint->aspectRatio();
		    });
		}
	    if( !File::exists($this->path.DS.'thumbs') ) {
	    	File::makeDirectory($this->path.DS.'thumbs', 0777, true);
	    }
		$image->save($this->path.DS.'thumbs'.DS.$this->name);
	}

	private function makeThumbNormal()
	{
		if( is_null($this->path) ) {
			return $this->error('Image\'s path cannot be blank.');
		}
		if( is_null($this->name) ) {
			return $this->error('Image\'s name cannot be blank.');
		}
		$image = Image::make($this->path.DS.$this->name);
		$image->resize(450, null, function($constraint){
	        $constraint->aspectRatio();
	    });
	    if( !File::exists($this->path.DS.'thumbs') ) {
	    	File::makeDirectory($this->path.DS.'thumbs', 0777, true);
	    }
		$image->save($this->path.DS.'thumbs'.DS.$this->name);
	}

	private function resetThumb()
	{
		do {
			$answer = $this->ask('Enter image\'s absolute path to reset thumb (empty means stop): ');
			if( !empty($answer) ) {
				if( !File::exists($answer) ) {
					$this->error('Path "'.$answer.'" did not exist.');
				} else {
					$path = $answer;
					$images = glob($path.DS.'*.{gif,jpg,jpeg,png}', GLOB_BRACE);
					$this->info("==============================================================\n".count($images).' image(s) found');
					foreach($images as $image) {
						$image = str_replace($path.DS, '', $image);
			            $this->call('image:process', ['--type' => 'thumb', '--path' => $path, '--name' => $image]);
					}
					$this->info(count($images)." image(s) reset.\n==============================================================");
				}
			}
		} while ( !empty($answer) );

	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('type', null, InputOption::VALUE_OPTIONAL, 'Type of image processing.', null),
			array('path', null, InputOption::VALUE_OPTIONAL, 'Path of image.', null),
			array('name', null, InputOption::VALUE_OPTIONAL, 'Name of image.', null),
			array('width', null, InputOption::VALUE_OPTIONAL, 'Name of image.', null),
		);
	}

}
