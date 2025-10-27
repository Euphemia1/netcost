</main>
<footer class="bg-light py-4 mt-5">
  <div class="container text-center text-muted small">
    <div>© <?php echo date('Y'); ?> LT Software. All rights reserved.</div>
    <div>Address: 123 Software Ave, Tech City &nbsp;|&nbsp; Email: info@ltsoftware.example &nbsp;|&nbsp; Phone: +1 (555) 123-4567</div>
  </div>
</footer>
  <!-- Back to top button -->
  <button id="back-to-top" aria-label="Back to top">▲</button>

  <!-- Product Modal (reused across site) -->
  <div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Loading...</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="/contact.php" class="btn btn-primary">Request Demo</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/js/main.js"></script>
  </body>
  </html>