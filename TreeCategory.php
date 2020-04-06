<?php
class TreeCategory
{
   public static function getTree($allArray)
   {
       $parents_arr = [];
       $treeElem = self::createTree($allArray, $parents_arr);
       self::generateElemenTree($treeElem, $parents_arr);
       return $treeElem;
   }

   protected static function createTree($allArray, $parents_arr)
   {
       foreach ($allArray as $key => $item){
           $parents_arr[$item->parent_id][$item->id] = $item;
       }
       $treeElem = $parents_arr[0];
       self::generateElemenTree($treeElem, $parents_arr);
       return $treeElem;
   }

   protected static function generateElemenTree(&$treeElem, $parents_arr)
   {
       foreach ($treeElem as $key => $item){
           if(!isset($item['children'])){
               $treeElem[$key]['children'] = array();
           }
           if(array_key_exists($key, $parents_arr)){
               $treeElem[$key]['children'] = $parents_arr[$key];
               $treeElement = $treeElem[$key]['children'];
               self::generateElemenTree($treeElement, $parents_arr);
           }
       }
   }

}