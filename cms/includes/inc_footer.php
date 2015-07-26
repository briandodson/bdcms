						<div class="clear"></div>
          </div>
          <div class="clear"></div>
        </div>
      </div>
      <div id="footer">
        <div class="actions">
          <ul>
            <li><a href="<?php echo ROOT_INDEX; ?>" target="_blank">View Site</a></li>
            <li><a href="support-ticket.php">Submit a Ticket</a></li>
            <li><a href="<?php echo $_SERVER['PHP_SELF']; ?>?logout=true">Log Out</a></li>
          </ul>
        </div>
        <div class="copy">
          &copy; Copyright <?php if (date("Y") == "2009"): echo "2009"; else: echo "2009 - ".date("Y"); endif ?>, <a href="http://www.bri-design.com" target="_blank">bri-design studios</a>. All Rights Reserved.<br />
          This Content Management System framework is owned by <a href="http://www.bri-design.com" target="_blank">bri-design studios</a> and deployed for licensed use for <?php SITE_NAME; ?> only. May be copied or redistributed without expressed permission by bri-design studios.
        </div>
      </div>
    </div>
  </div>