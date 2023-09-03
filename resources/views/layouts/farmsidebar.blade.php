  <div class="card">
      <div class="card-header">
          <h3 class="card-title">Profile</h3>
          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
              </button>
          </div>
      </div>
      <div class="card-body p-0">
          <ul class="nav nav-pills flex-column">
              <li class="nav-item active">
                  <a href="{{ route('f2.information', $f2_data->ff_id) }}"
                      class="nav-link mr-2 ml-2 @if (Request::segment(4) == 'information') active @endif ">
                      <i class="fas fa-inbox"></i>&nbsp;Personal Information
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('f2.details', $f2_data->ff_id) }}"
                      class="nav-link mr-2 ml-2 @if (Request::segment(4) == 'details') active @endif ">
                      <i class="far fa-envelope"></i>&nbsp;More Details
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('f2.livelihood', $f2_data->ff_id) }}"
                      class="nav-link mr-2 ml-2 @if (Request::segment(4) == 'livelihood') active @endif ">
                      <i class="far fa-file-alt"></i> Livelihood
                  </a>
              </li>

          </ul>
      </div>
      <!-- /.card-body -->
  </div>

  <div class="card">
      <div class="card-header">
          <h3 class="card-title">Activity</h3>

          <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
              </button>
          </div>
      </div>
      <div class="card-body p-0">
          <ul class="nav nav-pills flex-column">
              <li class="nav-item active">
                  <a href="{{ route('f2.farm', $f2_data->ff_id) }}" class="nav-link mr-2 ml-2 @if (Request::segment(4) == 'farm') active @endif ">
                      <i class="fas fa-inbox"></i>&nbsp;Farm Details
                  </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('f2.activity', $f2_data->ff_id) }}" class="nav-link mr-2 ml-2 @if (Request::segment(4) == 'activity') active @endif ">
                    <i class="fas fa-inbox"></i>&nbsp;Activity
                </a>
              </li>
          </ul>
      </div>
      <!-- /.card-body -->
  </div>
