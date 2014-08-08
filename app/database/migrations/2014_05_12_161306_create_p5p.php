<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateP5p extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('p5p', function($table)
        {
            $table->integer('user_id')->unsigned();
            $table->boolean('NO-TRACK')->default(false);
            $table->boolean('OSTRICH-MODE-PRIVACY')->default(false);
            $table->boolean('NO-EVIL')->default(false);
            $table->boolean('NO-PHISH')->default(false);
            $table->boolean('NO-FISH')->default(false);
            $table->boolean('NO-POPUPS')->default(false);
            $table->boolean('NO-ADS-IM-SURE-YOU-WILL-FIGURE-OUT-ANOTHER-BUSINESS-MODEL')->default(false);
            $table->boolean('NO-CELEBRITY-GOSSIP')->default(false);
            $table->boolean('SERVE-ME-ADS-BASED-ON-MY-SELF-IMAGE-RATHER-THAN-MY-BEHAVIOR')->default(false);
            $table->string('MOOD')->default('');
            $table->boolean('CAT-PERSON')->default(false);
            $table->boolean('DOG-PERSON')->default(false);
            $table->boolean('IS-A-DOG')->default(false);
            $table->string('USER-MIME-TYPE')->default('');
            $table->boolean('SORRY-I-AM-BROKE-RIGHT-NOW')->default(false);
            $table->string('SIGN')->default('');
            $table->string('FAVORITE-COLOR')->default('');
            $table->integer('AGE')->unsigned()->default(0);
            $table->integer('ACTUAL-AGE')->unsigned()->default(0);
            $table->boolean('DONT-TEL-MOM')->default(false);
            $table->boolean('I-AM-SCHMIDT')->default(false);
            $table->boolean('DO-NOT-SURE')->default(false);
            $table->boolean('DO-NO-CENSOR')->default(false);
            $table->boolean('I-OWN-MY-WORDS')->default(false);
            $table->boolean('FOSS-ONLY')->default(false);
            $table->boolean('NO-SHINY')->default(false);
            $table->boolean('OPEN-CONTENT-ONLY')->default(false);
            $table->boolean('GEEZ-I-AM-AT-WORK')->default(false);
            $table->boolean('YOUTUBE-YOU-MAY-THINK-YOU-ARE-FUNNY-BUT-YOU-ARE-NOT')->default(false);
            $table->boolean('INTERNETISSERIOUSBUSINESS')->default(false);
            $table->boolean('ICANHAZCHEEZBURGER')->default(false);
            $table->boolean('ICANHAZCAT')->default(false);
            $table->boolean('NO-MEMES')->default(false);
            $table->boolean('NO-MIMES')->default(false);
            $table->boolean('IS-A-MINOR')->default(false);
            $table->boolean('IS-A-MINER')->default(false);
            $table->boolean('NOT-PUNNY')->default(false);
            $table->string('SSN')->default('');
            $table->boolean('DONT-TASE-ME-BRO')->default(false);
            $table->string('COFFEE')->default('');
            $table->boolean('I-AM-COMFORTABLE-WITH-MY-WEIGHT-THANK-YOU')->default(false);
            $table->boolean('DO-NOT-CRASH')->default(false);
            $table->boolean('I-WEAR-A-TINFOIL-HAT')->default(false);
            $table->boolean('I-AM-JUST-IMPATIENT')->default(false);
            $table->boolean('GO-FASTER-I-AM-IN-A-HURRY')->default(false);
            $table->boolean('NO-RABBLE')->default(false);
            $table->boolean('PINKY-SWEAR')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('p5p');
    }

}
