<?php

class LogEntry extends Eloquent {
	protected $table      = 'logs';
	public    $timestamps = false;

	public static function takeNote($transEntry, $executed = null, $old = null, $new = null) {
		$entry = new LogEntry();

		$entry->executor   = Auth::user()->id;
		$entry->trans      = $transEntry;
		$entry->executed   = $executed;
		$entry->old        = $old;
		$entry->new        = $new;
		$entry->created_at = date('Y-m-d H:i:s');

		$entry->save();

		return $entry;
	}

	public function getDescription() {
		$args['executor'] = $this->executor ? User::find($this->executor)->nickname : trans('bbs.anon');
		$args['executed'] = $this->executed ? User::find($this->executed)->nickname : trans('bbs.anon');
		$args['old']      = $this->old ? $this->old : '';
		$args['new']      = $this->new ? $this->new : '';

		return trans($this->trans, $args);
	}

	public function executed() {
		$this->hasOne('User');
	}

	public function executor() {
		$this->hasOne('User');
	}

}
