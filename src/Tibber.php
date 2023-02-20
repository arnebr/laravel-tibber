<?php

namespace Arnebr\Tibber;

use Illuminate\Support\Facades\Http;

class Tibber
{
    public const HOURLY = 'HOURLY';

    public const DAILY = 'DAILY';

    public const WEEKLY = 'WEEKLY';

    public const MONTHLY = 'MONTHLY';

    public const ANNUAL = 'ANNUAL';

    public const APP_HOME = 'HOME';

    public const APP_CONSUMPTION = 'CONSUMPTION';

    public const APP_METER_READING = 'METER_READING';

    public const APP_COMPARISON = 'COMPARISON';

    private function request($query): array
    {
        $client = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->withToken(config('tibber.token'))->post(config('tibber.api_url'), [
            'query' => $query,
        ]);

        return $client->json();
    }

    public function viewer($subquery = '')
    {
        $query = <<<GQL
        query {
            viewer {
                login
                userId
                name
                accountType
                $subquery
            }
        }
        GQL;

        return $this->request($query);
    }

    public function homes($homeId = null, $subquery = '')
    {
        $action = ($homeId === null) ? 'homes' : 'home(id:'.$homeId.')';
        $subquery = <<<GQL
                $action {
                    $subquery
                    id
                    timeZone
                    appNickname
                    appAvatar
                    type
                    size
                    numberOfResidents
                    primaryHeatingSource
                    hasVentilationSystem
                    mainFuseSize
                    meteringPointData{
                      consumptionEan
                      gridCompany
                      gridAreaCode
                      productionEan
                      energyTaxType
                      vatType
                      estimatedAnnualConsumption
                    }
                    features {
                      realTimeConsumptionEnabled
                    }
                    owner{
                      id
                      isCompany
                      firstName
                      lastName
                      language
                      contactInfo {
                        email
                        mobile
                      }
                      organizationNo
                    }
                    address {

                      address1
                      address2
                      address3
                      postalCode
                      city
                      country
                      latitude
                      longitude
                    }
                    subscriptions {
                        id
                        subscriber {
                          id
                        }
                        validTo
                        validFrom
                        status


                      }
                      currentSubscription{
                        id
                        validTo
                        validFrom
                        subscriber{
                          id
                        }
                        priceInfo{
                          current{
                            total
                            energy
                            tax
                            startsAt
                            level
                          }
                          today {
                            total
                            energy
                            tax
                            startsAt
                            level
                          }
                          tomorrow {
                            total
                            energy
                            tax
                            startsAt
                            level
                          }
                        }
                      }
                  }
        GQL;

        return $this->viewer($subquery);
    }

    public function priceRating($homeId = null, $subquery = '')
    {
        $action = ($homeId === null) ? 'homes' : 'home(id:'.$homeId.')';
        $subquery = <<<GQL
                $action {
                    $subquery
                    id
                    currentSubscription {
                        status
                        priceRating {
                          hourly {
                           entries{
                            time
                            total
                            tax
                            energy
                            level
                          }


                          }
                        }
                      }

                  }
        GQL;

        return $this->viewer($subquery);
    }

    public function consumption($homeId = null, $resolution = Tibber::HOURLY, $last = 100)
    {
        $subquery = <<<GQL
        consumption(resolution: $resolution, last: $last) {
            nodes {
              from
              to
              cost
              unitPrice
              unitPriceVAT
              consumption
              consumptionUnit
              currency
            }
        }
        GQL;

        return $this->homes($homeId, $subquery);
    }

    public function sendPushNotification(string $title, string $message, $screenToOpen = Tibber::APP_HOME)
    {
        $subquery = <<<GQL
        mutation{
            sendPushNotification(input: {
              title: "$title",
              message: "$message",
              screenToOpen: $screenToOpen
            }){
              successful
              pushedToNumberOfDevices
            }
          }

        GQL;

        return $this->request($subquery);
    }
}
