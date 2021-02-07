
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
                              <input type="checkbox" name="caseCompleted" <?php echo $case_completed == '1' ? 'checked' : ''; ?>>
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
                              <input type="checkbox" name="caseInProgress" <?php echo $case_in_progress == '1' ? 'checked' : ''; ?>>
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
                              <input type="checkbox" name="caseWithdraw" <?php echo $case_withdraw == '1' ? 'checked' : ''; ?>>
                          </span>
                      </label>
                  </div>
                  <div class="form-radio-and-checkbox-input-response">
                  </div>    
                </div>
              </div>
            </div>