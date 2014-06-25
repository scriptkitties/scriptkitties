<?php

class AdminPageController extends BaseController {

	public function getEdit($pageID = 0) {
		if($pageID == 0) {
			$page = Page::first();
			return Redirect::to('admin/pages/edit/'.$page->id);
		}

		$page = Page::find($pageID);

		if($page == null) {
			App::abort(404);
		}

		$p = DB::table('pages')->select(['id', 'page'])->orderBy('page')->get();
		foreach($p as $q) {
			$pages[$q->id] = $q->page;
		}

		return View::make('pages.pages.edit', [
			'page'  => $page,
			'pages' => $pages
		]);;
	}

	public function postEdit($pageID = 0) {
		$page = Page::find($pageID);

		if($page == null) {
			App::abort(404);
		}

		$page->content = Input::get('content');
		$page->save();

		return Redirect::to('admin/pages/edit/'.$page->id)->with('alert-success', 'page updated');
	}

}
