<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsRegisteredInExamSessionUserEnrolls extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_session_user_enrolls', function (Blueprint $table) {
            $table->tinyInteger('is_registered')->after('user_session_code')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_session_user_enrolls', function (Blueprint $table) {
            $table->dropColumn('is_registered');
        });
    }
}
