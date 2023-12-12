      <table class="table table-bordered">
          <thead>
              <tr>
                  <th>Performance Measurement</th>
                  <th>Criteria</th>
                  <th>Total Actual Points/Rate</th>
                  <th>Passing Points/Rate</th>
                  <th>Ratee's Performance Level</th>
                  <th>Remarks</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($partsWithFactors as $index => $partWithFactors)
                  <tr>
                      <td>{{ $partWithFactors['part']->name }}</td>
                      <td>{{ $partWithFactors['part']->criteria_allocation }}%</td>
                      <td class="text-center">{{ $partWithFactors['totalRate'] }}</td>
                      @if ($loop->first)
                          <td style="text-align: center; vertical-align: middle" rowspan="4">80%</td>
                          <td rowspan="5">

                              @foreach ($ratingScales as $scale)
                                  @if ($scale['name'] == 'Outstanding')
                                      @if ($totalRateForAllParts >= 95)
                                          <strong style="color: #39BF26;"> 95-100%
                                              {{ $scale['name'] }}</strong>
                                      @else
                                          95-100% {{ $scale['name'] }}
                                      @endif
                                      <br>
                                  @elseif ($scale['name'] == 'High Average')
                                      @if ($totalRateForAllParts >= 90 && $totalRateForAllParts <= 94)
                                          <strong style="color: #268EBF;">90-94%
                                              {{ $scale['name'] }}</strong>
                                      @else
                                          90-94% {{ $scale['name'] }}
                                      @endif
                                      <br>
                                  @elseif ($scale['name'] == 'Average')
                                      @if ($totalRateForAllParts >= 80 && $totalRateForAllParts <= 89)
                                          <strong style="color: #B3BF26;">80-89%
                                              {{ $scale['name'] }}</strong>
                                      @else
                                          80-89% {{ $scale['name'] }}
                                      @endif
                                      <br>
                                  @elseif ($scale['name'] == 'Satisfactory')
                                      @if ($totalRateForAllParts >= 70 && $totalRateForAllParts <= 79)
                                          <strong style="color: #BF6226;">70-79%
                                              {{ $scale['name'] }}</strong>
                                      @else
                                          70-79% {{ $scale['name'] }}
                                      @endif
                                      <br>
                                  @elseif ($scale['name'] == 'Poor')
                                      @if ($totalRateForAllParts <= 69)
                                          <strong style="color: #BF3426;">69% & below
                                              {{ $scale['name'] }}</strong>
                                      @else
                                          69% & below {{ $scale['name'] }}
                                      @endif
                                  @endif
                              @endforeach

                          </td>
                      @endif
                      <td>
                          @if ($loop->iteration == 1)
                              @if ($totalRateForAllParts >= 80)
                                  <a class="btn btn-sm bg-success-light mr-2"><strong>Passed</strong></a>
                              @else
                                  Passed
                              @endif
                          @elseif ($loop->iteration == 2)
                              @if ($totalRateForAllParts < 80)
                                  <a class="btn btn-sm bg-danger-light mr-2"><strong>Failed</strong></a>
                              @else
                                  Failed
                              @endif
                          @endif
                      </td>
                  </tr>
              @endforeach
              <tr>
                  <td>Total</td>
                  <td>100%</td>
                  <td class="text-center"><strong>{{ $totalRateForAllParts }}</strong></td>
                  <td></td>
              </tr>
          </tbody>
      </table>
