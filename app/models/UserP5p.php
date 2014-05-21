<?php

class UserP5p extends Eloquent {
	protected $table = 'p5p';

	public static $types = [
		'NO-TRACK'                                                    => 'boolean',
		'OSTRICH-MODE-PRIVACY'                                        => 'boolean',
		'NO-EVIL'                                                     => 'boolean',
		'NO-PHISH'                                                    => 'boolean',
		'NO-FISH'                                                     => 'boolean',
		'NO-POPUPS'                                                   => 'boolean',
		'NO-ADS-IM-SURE-YOU-WILL-FIGURE-OUT-ANOTHER-BUSINESS-MODEL'   => 'boolean',
		'NO-CELEBRITY-GOSSIP'                                         => 'boolean',
		'SERVE-ME-ADS-BASED-ON-MY-SELF-IMAGE-RATHER-THAN-MY-BEHAVIOR' => 'boolean',
		'MOOD'                                                        => 'enum',
		'CAT-PERSON'                                                  => 'boolean',
		'DOG-PERSON'                                                  => 'boolean',
		'IS-A-DOG'                                                    => 'boolean',
		'USER-MIME-TYPE'                                              => 'enum',
		'SORRY-I-AM-BROKE-RIGHT-NOW'                                  => 'boolean',
		'SIGN'                                                        => 'string',
		'FAVORITE-COLOR'                                              => 'string',
		'AGE'                                                         => 'integer',
		'ACTUAL-AGE'                                                  => 'integer',
		'DONT-TEL-MOM'                                                => 'boolean',
		'I-AM-SCHMIDT'                                                => 'boolean',
		'DO-NOT-SURE'                                                 => 'boolean',
		'DO-NO-CENSOR'                                                => 'boolean',
		'I-OWN-MY-WORDS'                                              => 'boolean',
		'FOSS-ONLY'                                                   => 'boolean',
		'NO-SHINY'                                                    => 'boolean',
		'OPEN-CONTENT-ONLY'                                           => 'boolean',
		'GEEZ-I-AM-AT-WORK'                                           => 'boolean',
		'YOUTUBE-YOU-MAY-THINK-YOU-ARE-FUNNY-BUT-YOU-ARE-NOT'         => 'boolean',
		'INTERNETISSERIOUSBUSINESS'                                   => 'boolean',
		'ICANHAZCHEEZBURGER'                                          => 'boolean',
		'ICANHAZCAT'                                                  => 'boolean',
		'NO-MEMES'                                                    => 'boolean',
		'NO-MIMES'                                                    => 'boolean',
		'IS-A-MINOR'                                                  => 'boolean',
		'IS-A-MINER'                                                  => 'boolean',
		'NOT-PUNNY'                                                   => 'boolean',
		'SSN'                                                         => 'string',
		'DONT-TASE-ME-BRO'                                            => 'boolean',
		'COFFEE'                                                      => 'enum',
		'I-AM-COMFORTABLE-WITH-MY-WEIGHT-THANK-YOU'                   => 'boolean',
		'DO-NOT-CRASH'                                                => 'boolean',
		'I-WEAR-A-TINFOIL-HAT'                                        => 'boolean',
		'I-AM-JUST-IMPATIENT'                                         => 'boolean',
		'GO-FASTER-I-AM-IN-A-HURRY'                                   => 'boolean',
		'NO-RABBLE'                                                   => 'boolean',
		'PINKY-SWEAR'                                                 => 'boolean'
	];

	public static $enums = [
		'MOOD'           => [
		],
		'USER-MIME-TYPE' => [
		],
		'COFFEE'         => [
			'HOT'   => 'hot',
			'DECAF' => 'decaf',
			'BLANK' => 'blank',
			'MILK'  => 'milk',
			'ICED'  => 'iced'
		]
	];

	public function get($token) {
		return $this->{$token};
	}

	public function user() {
		return $this->belongsTo('user');
	}
}
