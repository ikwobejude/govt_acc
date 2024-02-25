<div class="accordion mt-3" id="accordionExample">
    <div class="card accordion-item">
      <h2 class="accordion-header" id="headingOne">
        <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#accordionOne" aria-expanded="true" aria-controls="accordionOne">
          Search
        </button>
      </h2>

      <div id="accordionOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
        <div class="accordion-body">
        </div>
      </div>
    </div>
</div>


{{-- ALTER TABLE `acct_budgets`
	CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT FIRST,
	ADD PRIMARY KEY (`id`);
ALTER TABLE `acct_budgets`
	ADD COLUMN `reason` VARCHAR(200) NOT NULL DEFAULT '0' AFTER `reapproved_by`;
    --}}
