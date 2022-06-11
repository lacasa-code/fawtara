<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElectronicinvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('electronicinvoices', function (Blueprint $table) {
            $table->id();

            $table->text('Invoice_type')->nullable();
            $table->text('Invoice_Number')->nullable();
            $table->text('Customer')->nullable();
            $table->text('customer_address')->nullable();
            $table->text('customer_vat')->nullable();
            $table->text('customer_phone')->nullable();
            $table->text('customer_number')->nullable();
            $table->text('Job_card')->nullable();
            $table->text('quotation_number')->nullable();
            $table->text('customer_po_number')->nullable();
            $table->text('branch_name')->nullable();
            $table->text('meters_reading')->nullable();
            $table->text('fleet_number')->nullable();
            $table->text('registeration')->nullable();
            $table->text('manufacturer')->nullable();
            $table->text('chassis_no')->nullable();
            $table->text('model_name')->nullable();
            $table->text('vehicle')->nullable();
            $table->text('Date')->nullable();
            $table->text('Discount')->nullable();
            $table->text('job_open_date')->nullable();
            $table->text('delivery_date')->nullable();
            $table->text('Details')->nullable();
            $table->text('vat_number')->nullable();
            $table->text('Status')->nullable();
            $table->text('Payment_type')->nullable();
            $table->float('services_sum')->nullable();
            $table->float('total_amount')->nullable();
            $table->float('grand_total')->nullable();
            $table->float('tax')->nullable();
            $table->float('paid_amount')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('electronicinvoices');
    }
}
