<?php
namespace Klevu\Receipe\Model\Product;

use Klevu\Search\Model\Product\Product as Klevu_Product;
use Klevu\Search\Helper\Data as Klevu_DataHelper;

class Product extends Klevu_Product
{
	
	private function getFinalListCategory($listCategoryArray,$product){
		
		if($product->getData('type_id') == 'receipe')
        {
            $result = ["KLEVU_PRODUCT;;KLEVU_CMS"];
        }else{
            $result = ["KLEVU_PRODUCT"];
        }
		$result = array_merge($result, $listCategoryArray);
		return array_unique($result);
	}
	
	public function getListCategory($parent,$item){
		 
		$result = [];		
        if ($parent) {            
			$listCategoryArray = $this->getCategoryNames( $parent->getCategoryIds() );
			$product['listCategory'] = $this->getFinalListCategory( $listCategoryArray, $parent);		
			
        } elseif ($item->getCategoryIds()) {			
            $listCategoryArray = $this->getCategoryNames( $item->getCategoryIds() );
			$product['listCategory'] = $this->getFinalListCategory( $listCategoryArray, $item);	
			
        } else {
            $product['listCategory'] = "KLEVU_PRODUCT";
        }
        return $product['listCategory'];
    }


	/**
     * Return a list of the names of all the categories in the
     * paths of the given categories (including the given categories)
     * up to, but not including the store root.
     *
     * @param array $categories
     *
     * @return array
     */
    public function getCategoryNames(array $categories)
    {		
        $category_paths = $this->getCategoryPaths();
        //$result = ["KLEVU_PRODUCT"];
		$result = [];
        foreach ($categories as $category) {
            if (isset($category_paths[$category])) {
                if(count($category_paths[$category]) > 0) {
                    $cat_path[$category][] = implode(";",$category_paths[$category]);
                } else {
                    $cat_path[$category] = $category_paths[$category];
                }
                $result = array_merge($result, $cat_path[$category]);
            }
        }
        return array_unique($result);
    }
	
	 

}
