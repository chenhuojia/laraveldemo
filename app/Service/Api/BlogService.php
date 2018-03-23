<?php
namespace App\Service\Api;
use App\Models\BlogModel;
use App\Models\BlogImgModel;
class BlogService{
    
    /**
     * 新增
     * @param unknown $request
     * @param unknown $user_id
     * @return unknown
     * ***/
    public static function create($request,$user_id){
        $blog=BlogModel::create([
            'user_id'=>$user_id,
            'section_id'=>$request->section_id,
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>strtotime($request->start_time),
            'deadline'=>($request->deadline?$request->deadline:0),
            'address'=>$request->address,
            'contact_phone'=>($request->contact_phone?$request->contact_phone:''),
            'longtitude'=>($request->longtitude?$request->longtitude:''),
            'latitude'=>($request->latitude?$request->latitude:''),
        ]);
        $images=[];
        if ($request->images){
            foreach ($request->images as $v){
                $images[]=['url'=>$v];
            }
            $blog->images()->createMany($images);
        }
        return $blog;
    }
    
    /**
     * 更新
     * @param unknown $request
     * @param unknown $user_id
     * @return unknown|boolean
     * ***/
    public static function update($request,$user_id){
        $blog=BlogModel::where(['id'=>$request->blog,'user_id'=>$user_id])->first();
        if ($blog){
            $blog->section_id=$request->section_id;
            $blog->title=$request->title;
            $blog->content=$request->content;
            $blog->start_time=strtotime($request->start_time);
            $blog->deadline=($request->deadline?$request->deadline:0);
            $blog->address=$request->address;
            $blog->contact_phone=($request->contact_phone?$request->contact_phone:'');
            $blog->longtitude=($request->longtitude?$request->longtitude:'');
            $blog->latitude=($request->latitude?$request->latitude:'');
            $blog->save();
            BlogImgModel::where(['blog_id'=>$request->blog])->delete();
            $images=[];
            if ($request->images){
                foreach ($request->images as $v){
                    $images[]=['url'=>$v];
                }
                $blog->images()->createMany($images);
            }
            return $blog;
        }
        return false;
    }
    
}