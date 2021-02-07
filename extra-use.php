
    <!-- print report popup -->
    <div class="black-cover-for-report"></div>
    <div class="print-report-popup">
      <div class="print-report-content">
        <form action="print-home-loan-report.php" method="POST">
          <h3 class="form-inline justify-content-between">
            <span class="set-theme-color"><i class="fas fa-print"></i> Print Report...</span>
            <i id="close-report-popup" class="far fa-times-circle set-theme-color"></i>
          </h3>
          <div class="form-group mt-3">
            <div class="row">
              <div class="col-md-12">
                  <label for="exampleInputCity1">Case Status</label>
                  
                  <div class="checkbox-container">
                    <label>
                        <span class="checkbox-icon-container">
                          <i class='mdi mdi-check icon-mr-5'></i>
                        </span>
                        <span class="checkbox-label">
                            Completed
                        </span>
                        <span class="checkbox-input-container">
                            <input type="checkbox" name="caseCompleted" checked>
                        </span>
                    </label>
                    <label>
                        <span class="checkbox-icon-container">
                          <i class='fas fa-spinner fa-spin icon-mr-5'></i>
                        </span>
                        <span class="checkbox-label">
                            In Progress
                        </span>
                        <span class="checkbox-input-container">
                            <input type="checkbox" name="caseInProgress" checked>
                        </span>
                    </label>
                    <label>
                        <span class="checkbox-icon-container">
                          <i class='fas fa-exclamation icon-mr-5'></i>
                        </span>
                        <span class="checkbox-label">
                            Withdraw
                        </span>
                        <span class="checkbox-input-container">
                            <input type="checkbox" name="caseWithdraw" checked>
                        </span>
                    </label>
                </div>
                <div class="form-radio-and-checkbox-input-response">
                </div>    
              </div>
            </div>
          </div>
          <div class="form-inline justify-content-end">
            <button class="btn btn-primary">Print</button>
          </div>
        </form>
      </div>
    </div>
