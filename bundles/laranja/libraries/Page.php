<?php

/**
 *
 */
class Page
{
	/**
	 * @var LaranjaStorage
	 */
	private $storage;
	private $content;
	private $data;

	/**
	 * @param $path
	 */
	function __construct($path)
	{
		$this->storage = LaranjaContent::get_storage($path);
	}

	/**
	 * @return bool
	 */
	function exists()
	{
		if ( ! $this->storage)
		{
			return false;
		}
		return true;
	}

	function fetch_children()
	{
		/*
		 * TODO: For each children, fetch and combine the content with page content
		 */
		$data = $this->get_data();
		$children = array();

		if ( ! array_key_exists('children', $this->data))
		{
			return $this->get_content();
		}

		for ($i=0;$i<count($data['children']);$i++)
		{
			/* Recursively fetch children of children page
			 */
			$page_child_obj = new Page($data['children'][$i]->path);
			$page_child['content'] = $page_child_obj->fetch_children();

			$page_child['grid'] = $data['children'][$i]->grid;
			$order = $data['children'][$i]->order;

			$children[$order] = $page_child;

		}
		/* Key is the order, so sort by key
		 */
		ksort($children);
		return $children;
	}

	function get_data()
	{
		if ( ! $this->data)
		{
			$this->data = $this->storage->get_data();
		}
		return $this->data;
	}

	/**
	 * @return mixed
	 */
	function get_content()
	{
		$data = $this->get_data();
		if (array_key_exists('content', $data))
		{
			return $data['content'];
		}
		return false;
	}
}
