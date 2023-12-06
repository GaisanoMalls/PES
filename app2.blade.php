  <div>
      <ul style="list-style: none;">
          <span>Direction: Rate the following factors by checking the appropriate box which
              indicates the most accurate appraisal of the ratee’s performance on the job.
              The rating scale are outlined below:
          </span>

          @foreach ($ratingScales as $scale)
              <div class="rating-scale-item">

                  <strong> <span class="rating-scale-acronym">{{ $scale->acronym }}=</span>
                      <span class="rating-scale-name"> {{ $scale->name }}:</span></strong>
                  <span class="rating-scale-description">{{ $scale->description }}</span>
              </div>
          @endforeach
          @foreach ($partsWithFactors as $partWithFactors)
              @if ($loop->first)
                  <li style="list-style: none;">
                      @if ($loop->first)
                          <div class="rating-scale"></div>
                          <h4 class="text-center">{{ $partWithFactors['part']->name }}</h4>
                      @endif
                      <ul style="list-style: none;">
                          @foreach ($partWithFactors['factors'] as $factorData)
                              @if ($loop->index < 2)
                                  <!-- Display only the first two factors -->
                                  <li style="list-style: none;">
                                      <div class="row">
                                          <div class="col-6 text-left">
                                              @if ($loop->first)
                                                  <h5 class="m-l-90 m-b-30">
                                                      Factors</h5>
                                              @endif
                                              <h5>{{ $factorData['factor']->name }}</h5>
                                              <p>{{ $factorData['factor']->description }}</p>
                                          </div>
                                          <div class="col-6 text-center">
                                              <div class="">
                                                  <label class="radio-inline">
                                                      @if ($loop->first)
                                                          <span>Allotted<br><br></span>
                                                      @endif
                                                      <span
                                                          class="box">{{ $factorData['rating_scales']->max('equivalent_points') }}%</span>
                                                  </label>

                                                  @foreach ($factorData['rating_scales'] as $ratingScale)
                                                      <label class="radio-inline">
                                                          <!-- Display rating scale and its equivalent points -->
                                                          {{ $ratingScale->acronym }}<br>
                                                          {{ $ratingScale->equivalent_points }}<br>

                                                          <!-- Radio button for each rating scale -->
                                                          <input class="custom-radio" type="radio"
                                                              name="rating_scale_id_{{ $factorData['factor']->id }}"
                                                              value="{{ $ratingScale->equivalent_points }}"
                                                              wire:model="selectedValues.{{ $factorData['factor']->id }}"
                                                              wire:click="updateSelectedValue({{ $factorData['factor']->id }}, {{ $ratingScale->equivalent_points }})">

                                                      </label>
                                                  @endforeach

                                                  <label class="radio-inline">
                                                      @if ($loop->parent->first && $loop->first)
                                                          <span>POINTS<br><br>
                                                      @endif
                                                      <span id="points-{{ $factorData['factor']->id }}" class="box">
                                                          {{ $selectedValues[$factorData['factor']->id] ?? 0 }}
                                                      </span>
                                                  </label>
                                              </div>
                                              <div class="comment m-t-10">
                                                  <div class="form-group">
                                                      <label for="">Specific situations/incidents
                                                          to
                                                          support rating:</label>
                                                      <textarea placeholder="Type here..." class="form-control" wire:model="factorNotes.{{ $factorData['factor']->id }}"
                                                          wire:change="updateNote({{ $factorData['factor']->id }}, $event.target.value)"></textarea>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </li>
                              @endif
                          @endforeach
                      </ul>
                      @if ($loop->last)
                          <div class="c m-t-20 m-r-15">
                              <strong>
                                  <span>Total Actual Points/Rate =
                                      <span class="box">
                                          {{ $totalRates[$partWithFactors['part']->id] }}</span>
                                  </span>
                              </strong>
                          </div>
                      @endif
                      <div class="m-b-30 p-20"></div>
                  </li>
              @endif
          @endforeach
      </ul>
  </div>
