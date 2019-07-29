<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\Choice;
use App\Level;
use App\Checklist;
use App\CaseStudy;
use App\Evaluation;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $multiples = [
            [
                'body' => '<p>Integer non turpis vitae nisl fermentum fermentum eget eu sem. Curabitur tempor, est nec consectetur maximus, neque massa tempor nibh, vel dictum augue orci a urna. Sed sem urna, auctor.</p>',
                'answer_type' => 'MULTIPLE',
                'level_id' => 1,
                'score' => 1,
                'choices' => [
                    [
                        'point' => 'a',
                        'body' => 'Nulla facilisis risus egestas lorem convallis interdum.',
                        'correct' => false
                    ],
                    [
                        'point' => 'b',
                        'body' => 'Proin vitae turpis at risus consectetur volutpat vitae et nisl.',
                        'correct' => true
                    ],
                    [
                        'point' => 'c',
                        'body' => 'Morbi vel lorem aliquet, bibendum lectus in, posuere diam.',
                        'correct' => false
                    ],
                    [
                        'point' => 'd',
                        'body' => 'Curabitur eu lacus a mi feugiat ultricies ut sed ex.',
                        'correct' => false
                    ],
                ]
            ],
            [
                'body' => '<p>Mauris consequat feugiat eros. Ut nec mattis purus, eget malesuada enim. Maecenas vehicula semper finibus. Suspendisse risus tellus, elementum a ultrices quis, hendrerit at elit. Suspendisse non dictum tellus, eget.</p>',
                'answer_type' => 'MULTIPLE',
                'level_id' => 1,
                'score' => 1,
                'choices' => [
                    [
                        'point' => 'a',
                        'body' => 'Sed molestie mi et neque interdum varius.',
                        'correct' => false
                    ],
                    [
                        'point' => 'b',
                        'body' => 'Sed eget mi quis diam laoreet consectetur quis quis est.',
                        'correct' => true
                    ],
                    [
                        'point' => 'c',
                        'body' => 'Phasellus eget enim nec mauris dapibus aliquet.',
                        'correct' => false
                    ],
                    [
                        'point' => 'd',
                        'body' => 'Proin congue metus eget nibh fringilla dapibus sollicitudin sit amet arcu.',
                        'correct' => false
                    ],
                ]
            ],
            [
                'body' => '<p>Phasellus in velit eget ex varius sodales. Fusce in tortor ac odio posuere convallis. In interdum laoreet rhoncus. Aenean vel lacus sed tortor placerat tempus. Mauris hendrerit ipsum nec vestibulum.</p>',
                'answer_type' => 'MULTIPLE',
                'level_id' => 1,
                'score' => 1,
                'choices' => [
                    [
                        'point' => 'a',
                        'body' => 'In gravida leo sit amet efficitur elementum.',
                        'correct' => true
                    ],
                    [
                        'point' => 'b',
                        'body' => 'Donec non tortor ac tellus ullamcorper pharetra.',
                        'correct' => false
                    ],
                    [
                        'point' => 'c',
                        'body' => 'Sed ut nunc id lorem gravida volutpat eu ac justo.',
                        'correct' => false
                    ],
                    [
                        'point' => 'd',
                        'body' => 'Cras vel orci sollicitudin metus semper consequat ut sit amet lectus.',
                        'correct' => false
                    ],
                ]
            ],
            [
                'body' => '<p>Morbi quis magna metus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam pulvinar nisl non felis tempor, vel consectetur nisl ultricies. Nam consequat lacus.</p>',
                'answer_type' => 'MULTIPLE',
                'level_id' => 1,
                'score' => 1,
                'choices' => [
                    [
                        'point' => 'a',
                        'body' => 'Donec et purus id ipsum convallis rutrum vitae vel elit.',
                        'correct' => false
                    ],
                    [
                        'point' => 'b',
                        'body' => 'Vestibulum eget nisi ac sem ultrices vestibulum in posuere mi.',
                        'correct' => true
                    ],
                    [
                        'point' => 'c',
                        'body' => 'Nulla et lacus tristique, scelerisque leo quis, hendrerit sapien.',
                        'correct' => false
                    ],
                    [
                        'point' => 'd',
                        'body' => 'Pellentesque cursus tellus quis eleifend molestie.',
                        'correct' => false
                    ],
                ]
            ],
            [
                'body' => '<p>Nam vel nisl ac diam pretium dignissim quis sed tortor. Cras et enim sed felis lacinia vestibulum. Fusce malesuada ac turpis sed luctus. Vestibulum convallis massa nec pretium porttitor. Suspendisse.</p>',
                'answer_type' => 'MULTIPLE',
                'level_id' => 1,
                'score' => 1,
                'choices' => [
                    [
                        'point' => 'a',
                        'body' => 'Duis ultrices odio eu quam faucibus tristique.',
                        'correct' => false
                    ],
                    [
                        'point' => 'b',
                        'body' => 'In placerat arcu id bibendum condimentum.',
                        'correct' => false
                    ],
                    [
                        'point' => 'c',
                        'body' => 'Vestibulum nec nibh in diam pharetra pulvinar.',
                        'correct' => true
                    ],
                    [
                        'point' => 'd',
                        'body' => 'Fusce nec orci venenatis, hendrerit diam vel, tincidunt eros.',
                        'correct' => false
                    ],
                ],
            ],
        ];

        foreach ($multiples as $key => $multi) {
            $question = Question::create([
                'number' => $key + 1,
                'body' => $multi['body'],
                'answer_type' => $multi['answer_type'],
                'level_id' => $multi['level_id'],
                'score' => $multi['score'],
            ]);

            foreach ($multi['choices'] as $choice) {
                Choice::create([
                    'point' => $choice['point'],
                    'body' => $choice['body'],
                    'correct' => $choice['correct'],
                    'question_id' => $question->id,
                ]);
            }
        }

        $cases = [
            [
                [
                    'title' => 'Pellentesque fermentum',
                    'body' => '<p>Aenean gravida id odio nec fringilla. Nulla egestas suscipit nisl efficitur hendrerit. Cras ligula nunc, aliquam molestie aliquam eu, efficitur sed augue. Vivamus lacinia turpis quis mi fermentum consectetur. Vivamus in tristique diam, at cursus massa. Quisque ultricies accumsan dui, a tempor sapien congue dictum. Integer sollicitudin faucibus nisi ac lacinia. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer a volutpat quam, id ullamcorper massa. Integer consectetur sed dolor ut malesuada. Sed a risus non ante sollicitudin finibus. Quisque convallis mi vel augue fringilla, id ornare massa vulputate. Sed laoreet sit amet lorem nec volutpat.</p><p>Cras volutpat placerat facilisis. Sed id nisi nisi. Sed consequat mi non cursus tincidunt. Suspendisse euismod rutrum velit nec aliquet. Vivamus vel augue a ligula elementum pharetra. Nam eget lacinia dolor. Ut porttitor dictum eros, et dapibus mauris semper ac. Nam iaculis eleifend dui, a ullamcorper sem sollicitudin vel. Nam malesuada lobortis diam, luctus tristique urna hendrerit sit amet. Donec semper enim at lacus vehicula, sit amet lacinia magna finibus. Cras accumsan diam dignissim ante interdum aliquam. Cras sit amet dui nisi. Proin ultricies auctor varius. Duis non consequat tellus, sed malesuada augue. Ut rhoncus, augue in auctor tincidunt, lectus urna sollicitudin turpis, nec interdum quam ipsum ut risus.</p><p>Maecenas porttitor nibh vitae facilisis venenatis. Integer mollis lorem mi, in placerat turpis sodales suscipit. Fusce porttitor dignissim risus et convallis. Suspendisse placerat erat sit amet semper euismod. Maecenas pulvinar vestibulum risus, at mattis lorem maximus sit amet. Duis vitae pharetra libero. Nam vel faucibus augue.</p><p>Fusce mattis pellentesque sapien ut efficitur. Nam sodales massa turpis, sed condimentum turpis maximus at. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris pellentesque rhoncus tortor, quis elementum tellus placerat at. Quisque et justo lacus. Ut dapibus nec urna at vulputate. Sed sed luctus ante, in placerat neque. Pellentesque commodo turpis et diam posuere vulputate id laoreet dolor. Morbi in metus quis ante accumsan venenatis sit amet ac libero. Donec turpis eros, pharetra at convallis a, sodales in elit. Morbi gravida tortor et sem commodo tempor. Sed cursus posuere nisi non bibendum. Etiam pretium urna tincidunt justo posuere varius.</p>',
                    'type' => 'TEXT',
                ],
                [
                    'title' => 'Praesent non purus ultrices',
                    'body' => '<p>Maecenas sed dolor et mi pellentesque venenatis ut ullamcorper augue. Duis arcu sem, condimentum a pellentesque a, placerat eget urna. Sed bibendum, nibh nec placerat mattis, lorem metus porta est, nec laoreet tortor felis in libero. Sed viverra venenatis sodales. Ut accumsan venenatis sagittis. Vestibulum mollis suscipit orci ut hendrerit. Aliquam luctus, purus nec facilisis tincidunt, mauris purus sollicitudin turpis, et placerat felis nulla eu leo. Praesent enim risus, suscipit ut orci quis, fermentum mollis quam.</p><p>Duis ornare fermentum est, sed porttitor tellus imperdiet quis. Curabitur tincidunt velit felis, vitae lacinia augue commodo vel. Vivamus a felis nec orci aliquam rhoncus eget ac elit. Ut pulvinar lacus eros, a accumsan lacus dignissim non. Cras condimentum dignissim fringilla. Ut ut lorem sit amet neque pellentesque efficitur a non ante. Nam commodo feugiat odio sit amet vestibulum. Praesent faucibus quam luctus felis venenatis vehicula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum consectetur, dui et porttitor vulputate, dui ante interdum nibh, efficitur aliquet turpis ligula nec est. Nam vitae sagittis nunc. Nunc quis metus sit amet nunc rutrum malesuada.</p><p>Maecenas vel dictum felis. Morbi aliquet lobortis nisi, nec iaculis mi. Sed lorem dui, vestibulum et ex in, cursus imperdiet turpis. Nam a pretium leo. Integer ultrices arcu non feugiat viverra. In eu est imperdiet, tempus risus nec, ornare ipsum. Maecenas consectetur ultrices malesuada. Aenean sed arcu egestas, mollis orci quis, imperdiet est. Quisque id risus vitae eros luctus tristique. Donec euismod sit amet lectus non malesuada. Sed placerat velit nibh, sollicitudin rhoncus nisl tempor eget. Vivamus sed ligula pretium, consequat quam at, viverra nulla. Maecenas nisi risus, ultricies vel felis sed, placerat porttitor massa. Sed arcu dui, scelerisque ut maximus auctor, pretium interdum urna.</p><p>Curabitur accumsan est eget nibh sollicitudin, vitae accumsan odio lacinia. Phasellus et enim semper, fermentum enim non, iaculis magna. Ut at mauris eget risus suscipit tempus. Duis commodo elit ac urna tempus, mattis sollicitudin ante cursus. Suspendisse in augue id magna consequat porta. Suspendisse lacinia interdum est, quis elementum dolor accumsan non. Praesent eleifend sed eros sed ornare. Nullam rhoncus scelerisque porta. Curabitur ut ornare massa. Donec consectetur nibh at nisl commodo, et tempor lectus luctus. Nunc est nulla, laoreet et sodales nec, convallis in nulla. Sed dignissim non lacus ac venenatis. Donec a sodales dui. Fusce sit amet ex lacinia, volutpat magna at, consectetur sem. Vivamus congue urna ac dictum luctus.</p>',
                    'type' => 'TEXT',
                ],
            ],
            [
                [
                    'title' => 'Duis sagittis lorem',
                    'body' => '<p>Nullam consequat, libero in viverra eleifend, erat est vestibulum erat, a faucibus mauris velit et ligula. Integer volutpat nulla a mattis pharetra. Nullam in odio id eros pellentesque vehicula eget a nisl. Integer enim risus, tincidunt eget enim at, venenatis consequat sem. Fusce condimentum accumsan finibus. Nullam nec odio in nunc ullamcorper rhoncus convallis sed leo. Morbi fringilla viverra nunc a tincidunt. Quisque dignissim efficitur augue eu vulputate. Sed ligula dui, dignissim id mi id, maximus elementum massa. Praesent faucibus arcu sed quam semper sodales. Proin non urna odio. Proin urna ligula, rhoncus vitae pretium eget, aliquam vitae enim. In in suscipit arcu. Morbi semper neque vitae rutrum euismod.</p><p>Pellentesque et ligula porta, semper tortor vel, cursus magna. Praesent sed nunc id urna tempor venenatis. Vivamus laoreet ligula at ante efficitur venenatis. Etiam eget metus id tellus tincidunt pulvinar. Ut ac sem egestas, suscipit tortor sed, egestas velit. Aenean malesuada, nisl eget dignissim tristique, odio ipsum tempus elit, a ornare felis enim et nisl. Nunc laoreet, erat feugiat lacinia varius, urna massa viverra orci, ac dictum nunc sapien eget erat. Maecenas placerat odio dapibus, sodales ex et, vulputate sem. Morbi lobortis odio ac justo vulputate, vel consectetur mauris ornare. Praesent a varius odio. Pellentesque lacus turpis, convallis ut blandit quis, faucibus aliquet purus.</p><p>Fusce tincidunt finibus nibh. Vestibulum sagittis neque in lacus mollis, a eleifend ligula pellentesque. Donec ac hendrerit dolor. Sed pretium est a ligula sollicitudin, vel auctor est dictum. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla purus libero, finibus ultricies erat molestie, egestas vulputate leo. Phasellus convallis, tortor ac aliquam tempor, elit lectus hendrerit purus, vel mattis metus sapien sit amet velit. Nam dictum, eros ac maximus facilisis, mauris mauris luctus augue, nec cursus lacus arcu ut metus. Nulla quis bibendum enim, id maximus mi. Sed imperdiet nulla tortor. Praesent bibendum lobortis purus. Duis convallis dapibus vestibulum. Sed faucibus mattis enim at congue.</p><p>Vestibulum mattis rhoncus dictum. In ut tortor vitae enim congue fringilla. In lacinia nisi tempor bibendum vestibulum. Duis luctus volutpat tincidunt. Interdum et malesuada fames ac ante ipsum primis in faucibus. Nullam feugiat bibendum odio, a posuere quam ornare id. Etiam non purus suscipit, facilisis est fringilla, gravida nunc.</p>',
                    'type' => 'TEXT',
                ],
                [
                    'title' => 'Vivamus eu turpis',
                    'body' => '<p>Proin nec sapien urna. Nulla euismod purus tempus, imperdiet ante vitae, efficitur augue. Fusce id urna lectus. Nulla suscipit, sapien et commodo commodo, velit mi porta risus, ut lacinia diam libero a nulla. Mauris gravida sem a luctus finibus. Etiam accumsan, ex eu luctus dignissim, nunc augue porttitor ligula, a commodo risus quam id turpis. Nam nec condimentum turpis, vitae elementum nisi. Maecenas vulputate id diam eget tempus. Donec in tortor id nisl tincidunt consequat vel quis lacus. Mauris metus nulla, blandit vitae felis sit amet, tempus tempor massa. Etiam placerat, nunc in venenatis rhoncus, sem erat fringilla erat, eu rhoncus nunc libero vitae orci.</p><p>In nulla mi, lacinia ac dolor id, laoreet sodales lacus. Etiam pharetra non tortor vulputate molestie. Sed volutpat consectetur justo, nec sollicitudin ipsum viverra non. Nam ultricies dolor ac ante mollis porttitor. Suspendisse viverra velit nec quam semper rutrum scelerisque nec turpis. Quisque commodo metus id feugiat aliquam. Duis aliquet bibendum fringilla. Praesent ultrices ut velit vel imperdiet. Nam vitae rutrum nibh. Aenean vitae tristique ligula. Vestibulum porta tellus ligula, sit amet porttitor turpis euismod vitae. Nam fringilla vehicula vehicula. Phasellus dignissim ex lacus, in feugiat erat sollicitudin in. Nunc vitae pretium ex. Etiam ante magna, mollis non gravida ac, tempus vitae massa. Curabitur ullamcorper nibh ante, condimentum dictum arcu egestas volutpat.</p><p>Donec egestas blandit posuere. Vivamus rutrum mollis diam, sit amet maximus libero mollis vel. Phasellus quis lectus nec neque lobortis placerat non vitae quam. Maecenas non tellus accumsan, ultricies lorem id, venenatis est. Vivamus ac velit eu neque elementum tristique. Nullam fringilla libero arcu, quis iaculis metus vulputate non. Mauris consectetur feugiat lectus. Quisque condimentum finibus mauris, euismod pellentesque eros iaculis in. Praesent quis arcu varius, convallis nisl id, tempus sem. Morbi ut mauris a lectus faucibus scelerisque sed non mauris. Vivamus dignissim tellus quis arcu vehicula, tempus cursus tellus ultrices.</p><p>Suspendisse mattis fermentum risus, mollis volutpat mauris. Vestibulum pretium enim eu erat venenatis, non posuere turpis tristique. Curabitur interdum id diam in volutpat. Vivamus dignissim sem nisl. Nullam nibh ante, consequat in finibus ac, pellentesque quis magna. Praesent iaculis ipsum tempor ex suscipit, at facilisis ante vulputate. Morbi ac maximus leo. Proin bibendum, quam a sollicitudin mollis, justo sem bibendum turpis, non laoreet ipsum nunc id velit. Aliquam auctor purus vel nisi eleifend, id mollis ante convallis. Vivamus in augue non urna porta tempus eget vitae ex. Vestibulum auctor varius metus, a rutrum nulla lobortis in. Vivamus in mi non elit condimentum convallis. Donec et porta mauris, eu maximus dolor. Sed semper est eget mauris ullamcorper tempus. Donec aliquam placerat mi id rhoncus. Aliquam aliquet scelerisque metus vitae lacinia.</p>',
                    'type' => 'TEXT',
                ],
            ],
            [
                [
                    'title' => 'Mauris rhoncus',
                    'body' => '<p>Cras ultrices sapien nisl, a auctor lorem tempus eget. Etiam elementum magna eu felis suscipit auctor. Curabitur ut velit lectus. Aenean consectetur mi eu metus sodales, sit amet aliquet sem convallis. Phasellus non imperdiet sem. Fusce consectetur egestas convallis. Morbi bibendum, enim in efficitur maximus, arcu libero euismod libero, nec fermentum metus lorem dignissim risus. Pellentesque at erat hendrerit, tincidunt ex eget, tempor enim. Quisque molestie leo massa, in vulputate orci commodo sed. Curabitur volutpat nibh vitae diam mattis, ac imperdiet sem rhoncus. Ut eleifend sagittis turpis quis sagittis.</p><p>Maecenas nec tristique leo. Nam ut tempor justo. Etiam justo sapien, vestibulum quis mattis ac, consectetur at quam. Morbi condimentum urna nec lacus interdum, commodo malesuada velit lobortis. Nullam lectus nulla, accumsan vitae dictum et, gravida nec diam. Ut pharetra, leo vel pretium convallis, turpis nibh consequat metus, nec faucibus diam erat at dui. Pellentesque ut metus at quam vehicula aliquet vitae nec ligula.</p><p>Nam orci nulla, facilisis nec auctor ullamcorper, malesuada et turpis. Mauris porttitor molestie pulvinar. Etiam blandit lorem sed dictum egestas. Nam tincidunt lacus a leo molestie, eu elementum urna bibendum. Vivamus ultrices ex turpis, nec tristique lacus posuere sit amet. Etiam arcu lorem, tristique quis nisl eget, viverra euismod lorem. Donec placerat urna nunc, non tincidunt velit luctus accumsan. Morbi enim leo, laoreet at rutrum sed, fringilla a erat. Integer ac sapien leo. Maecenas porttitor odio eu venenatis tincidunt. Etiam accumsan tristique justo, eget ultrices nulla luctus et. Suspendisse pulvinar augue augue, sed egestas libero suscipit sit amet. Pellentesque viverra in nisi ac vulputate. Nullam sit amet elit sit amet lacus aliquam venenatis. Mauris rutrum imperdiet placerat.</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum malesuada, velit ac congue rhoncus, nunc nulla dignissim felis, suscipit bibendum est massa eu orci. Maecenas at ante ligula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean in tristique ante, ac tristique velit. Mauris lacinia justo eu diam efficitur posuere. Integer eu est nulla. Phasellus luctus consequat purus, eget viverra metus pulvinar eu. In aliquam metus eleifend, dictum diam ac, suscipit justo. Suspendisse luctus quis ligula ac porttitor. Aenean consectetur mi non urna convallis porta. Nam efficitur nisi eget sem dignissim, a malesuada metus malesuada. Cras eget molestie nulla. Suspendisse sollicitudin tellus justo, ac luctus turpis tempus eu. Phasellus varius et felis ac porttitor.</p>',
                    'type' => 'TEXT',
                ],
                [
                    'title' => 'Nulla bibendum odio',
                    'body' => '<p>Aenean ullamcorper convallis massa, at iaculis tortor accumsan sed. Sed facilisis et magna sit amet rutrum. Proin placerat lorem non odio fringilla, eget commodo quam viverra. Donec sed augue nisi. Curabitur vel odio luctus, lacinia massa a, vestibulum sem. Mauris faucibus metus vitae nulla cursus tincidunt. Aliquam erat volutpat.</p><p>Nunc malesuada diam nec vestibulum imperdiet. Quisque fringilla ac nibh eu egestas. Praesent tempus mollis orci in malesuada. Sed ac tincidunt leo, sed porta massa. Nam quam sapien, pellentesque vitae auctor vitae, aliquet sed nulla. Proin nec hendrerit tortor, nec sagittis justo. Vestibulum tincidunt dui a elementum euismod. Phasellus lobortis tincidunt sagittis. Donec eros urna, mattis non tincidunt at, euismod non sapien. Donec eu dictum justo. Nunc in lorem fringilla, tincidunt est id, dignissim arcu. Integer bibendum magna ut urna lacinia, et porttitor mauris convallis. Phasellus pharetra tincidunt elit vel commodo. Curabitur sagittis, ipsum eget ultricies facilisis, odio eros auctor enim, ultrices facilisis lectus orci auctor neque. Integer in erat vel urna semper pulvinar.</p><p>Aliquam sed posuere justo. Ut nec eros egestas, tincidunt justo elementum, ullamcorper sem. Ut vel ullamcorper mauris. Vestibulum hendrerit porttitor gravida. Praesent porta, lacus sit amet placerat pellentesque, nulla purus pretium dui, id eleifend mi magna eu quam. Duis aliquet, nisi nec consequat tempor, mauris diam volutpat nulla, a auctor neque risus varius mi. Pellentesque fringilla sodales sem quis tincidunt. Sed tellus nibh, placerat sit amet maximus condimentum, condimentum in urna.</p><p>Praesent sollicitudin risus justo, eu fermentum erat dictum at. Nulla at lacinia augue. Praesent euismod et purus eu gravida. Pellentesque id eleifend purus. Sed at laoreet dui. Nulla facilisi. Nullam sed erat ut ipsum auctor viverra. Cras egestas nibh et ipsum euismod, quis hendrerit est euismod. Nullam posuere maximus sem, venenatis posuere est.</p>',
                    'type' => 'TEXT',
                ],
            ],
            [
                [
                    'title' => 'Donec vestibulum tortor',
                    'body' => '<p>Cras eu fermentum sem. Sed sodales urna nec leo fermentum malesuada. Phasellus ultrices tempus neque vel volutpat. Duis quis condimentum felis. Nullam fringilla rutrum nunc a malesuada. Proin convallis semper lectus at porta. Vestibulum sed semper ante. Praesent eu nisi eu dui porta sagittis ut quis elit. Proin dapibus consequat porta.</p><p>Aenean efficitur magna eget tincidunt varius. Aenean mattis tristique nibh, non placerat eros. Maecenas sit amet nisi et urna congue posuere. Fusce vitae faucibus ipsum. Nam aliquet cursus nisi nec viverra. Aliquam erat volutpat. Nullam vitae dolor vel tellus maximus faucibus. Sed varius nisi eget lobortis lobortis.</p><p>Fusce sollicitudin mollis efficitur. Aenean nulla elit, egestas eget tristique nec, maximus ac nunc. In hac habitasse platea dictumst. Phasellus ex ex, dignissim vel facilisis suscipit, efficitur eget eros. Integer lobortis dui vitae auctor cursus. Phasellus porta ante a tortor ultrices, at hendrerit tellus euismod. Sed eu sem eget quam malesuada gravida.</p><p>Nunc vel congue ante, nec tempor arcu. Fusce in metus non ex euismod elementum. Sed luctus, nibh a interdum sodales, libero lectus elementum massa, ut congue lorem justo ut enim. Sed cursus scelerisque libero, eget pellentesque erat malesuada vitae. Nullam faucibus semper risus, eget fermentum nibh porttitor eu. Fusce in urna et tortor imperdiet venenatis sed ac metus. Maecenas mattis mattis felis, sed tempor elit.</p>',
                    'type' => 'TEXT',
                ],
                [
                    'title' => 'Nunc ac magna a turpis',
                    'body' => '<p>Phasellus ante mi, bibendum nec gravida ac, consequat id augue. Curabitur et nisi turpis. Duis imperdiet massa nec aliquet aliquam. Etiam tincidunt, nunc vitae faucibus viverra, felis leo fermentum nibh, eu laoreet lectus nulla ut enim. Sed fringilla elementum orci ac laoreet. Mauris est libero, pretium a eros blandit, suscipit scelerisque nisi. Maecenas pellentesque urna libero, sed hendrerit lectus ultrices eget. Morbi vel dignissim leo.</p><p>Pellentesque vel urna euismod, interdum diam in, posuere ante. Praesent posuere, odio quis semper posuere, eros massa pellentesque tellus, et eleifend felis ligula vel odio. Etiam blandit vel nulla lacinia cursus. Etiam eu vestibulum est. Praesent rhoncus enim orci, at pellentesque dui sodales sed. Phasellus in sapien at sapien facilisis tincidunt ac eu nunc. Mauris eu tortor eros. Fusce semper dignissim justo eget consequat. Praesent mattis sem eu nisi ultricies ultrices. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget enim mi. In vitae velit ac sapien egestas hendrerit. Phasellus nec ipsum in turpis ornare placerat non a mauris. Aenean in lorem lacinia, ornare odio a, vulputate odio. Nulla euismod, diam at pretium tristique, purus purus blandit libero, eu porttitor tellus sapien sit amet nulla.</p><p>Morbi vehicula eros ac quam vulputate pharetra. Curabitur fringilla nisl eu purus bibendum tempor. Aenean vitae pellentesque felis, ac posuere tellus. Nam placerat auctor sem eu laoreet. Pellentesque vel felis sed mauris venenatis facilisis. Donec neque tortor, rutrum id libero quis, tincidunt tristique metus. Proin imperdiet faucibus ligula in ullamcorper. Phasellus urna odio, rutrum id neque non, tempor fringilla arcu. Phasellus in gravida massa. In euismod sed arcu ac pulvinar.</p><p>Phasellus commodo tellus ante, accumsan porta eros sollicitudin sit amet. Cras id imperdiet mi. Donec feugiat aliquam diam convallis dapibus. Ut a imperdiet dolor. Suspendisse porta vehicula velit in fringilla. Nullam sed lobortis dolor, id pellentesque nisi. Etiam tincidunt, turpis vel iaculis elementum, dolor nulla egestas dolor, ac feugiat odio nisi non libero. Proin facilisis et erat nec tristique. Morbi pellentesque leo ipsum, id bibendum nulla tristique vitae. Duis ac ipsum tempor lacus volutpat rutrum. Pellentesque id arcu nec leo tincidunt tempor. Praesent suscipit ultricies elementum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Proin ultrices pretium nisi, ornare ornare est dignissim nec. Sed varius metus ac urna tincidunt, a malesuada leo mattis.</p>',
                    'type' => 'TEXT',
                ],
            ],
        ];

        foreach ($cases as $i => $case) {
            foreach ($case as $j => $c) {
                CaseStudy::create([
                    'number' => $j + 1,
                    'title' => $c['title'],
                    'body' => $c['body'],
                    'type' => $c['type'],
                    'level_id' => $i + 1,
                ]);
            }
        }

        $checklists = [
            [
                [
                    'number' => 1,
                    'body' => '<p>Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Curabitur dictum auctor mi, at dapibus justo porta in. Fusce vehicula vehicula faucibus. Nullam quis justo et lectus.</p>',
                    'answer_type' => 'CHECKLIST',
                    'score' => 2,
                    'checklists' => [
                        [
                            'body' => 'Fusce sodales odio eu condimentum facilisis.',
                        ],
                        [
                            'body' => 'Aliquam efficitur massa bibendum aliquet feugiat.',
                        ],
                        [
                            'body' => 'Quisque tempor eros eget ultricies gravida.',
                        ],
                        [
                            'body' => 'Aliquam vitae libero sed sapien porta vehicula ac ac purus.',
                        ],
                        [
                            'body' => 'Fusce gravida magna porta tincidunt vehicula.',
                        ],
                        [
                            'body' => 'Ut vehicula ex sit amet dolor sagittis lacinia.',
                        ],
                    ],
                ],
                [
                    'number' => 1,
                    'body' => '<p>Sed maximus pellentesque risus ac tincidunt. Nunc ac volutpat felis. Curabitur tortor mauris, iaculis finibus enim vel, congue fringilla nulla. Quisque nec nisl tincidunt dui tincidunt luctus a vitae ante.</p>',
                    'answer_type' => 'CHECKLIST',
                    'score' => 2,
                    'checklists' => [
                        [
                            'body' => 'Donec in augue eu turpis ultricies efficitur eu quis risus.',
                        ],
                        [
                            'body' => 'Vestibulum viverra ante vel lacinia euismod.',
                        ],
                        [
                            'body' => 'Proin eu massa tristique, lacinia orci vel, feugiat nunc.',
                        ],
                        [
                            'body' => 'Nunc viverra nibh vitae ex vulputate egestas.',
                        ],
                        [
                            'body' => 'Aliquam pulvinar neque a massa iaculis, nec hendrerit tortor volutpat.',
                        ],
                        [
                            'body' => 'Suspendisse et sapien imperdiet, suscipit nisi sit amet, viverra massa.',
                        ],
                    ],
                ],
            ],
            [
                [
                    'number' => 1,
                    'body' => '<p>Aliquam mi arcu, ultricies nec justo eget, convallis vulputate odio. Nunc sed placerat orci. Nam porta nibh in consectetur fermentum. Nam molestie felis sed lectus dignissim vulputate. Maecenas sapien lectus.</p>',
                    'answer_type' => 'CHECKLIST',
                    'score' => 1,
                    'checklists' => [
                        [
                            'body' => 'Aenean nec enim ut lorem consequat pharetra ut in nisi.',
                        ],
                        [
                            'body' => 'Aliquam vel lorem at nisi rutrum faucibus.',
                        ],
                        [
                            'body' => 'Suspendisse ultricies nibh at molestie dapibus.',
                        ],
                        [
                            'body' => 'Ut id purus quis nibh volutpat volutpat vitae sit amet libero.',
                        ],
                        [
                            'body' => 'Sed tempus arcu sit amet elit fermentum, ac ultricies enim pretium.',
                        ],
                        [
                            'body' => 'Proin eleifend arcu a neque auctor varius.',
                        ],
                    ],
                ],
                [
                    'number' => 1,
                    'body' => '<p>Donec a libero malesuada, lacinia nisi non, elementum lacus. Phasellus eu elit tortor. Duis accumsan nisi urna, sit amet molestie erat sagittis ullamcorper. Maecenas dui orci, aliquam eget ligula sit.</p>',
                    'answer_type' => 'CHECKLIST',
                    'score' => 1,
                    'checklists' => [
                        [
                            'body' => 'Cras non dolor luctus, efficitur leo at, euismod ex.',
                        ],
                        [
                            'body' => 'Suspendisse quis lacus non justo dapibus rutrum.',
                        ],
                        [
                            'body' => 'Nullam porttitor nulla at enim dignissim, vel tincidunt lorem suscipit.',
                        ],
                        [
                            'body' => 'Fusce sit amet augue vitae sem cursus pellentesque.',
                        ],
                        [
                            'body' => 'Donec quis velit et nulla fermentum placerat ut ut nulla.',
                        ],
                        [
                            'body' => 'Maecenas rutrum ipsum sed urna viverra hendrerit.',
                        ],
                    ],
                ],
            ],
        ];

        $cl_answers = [null,1,2,3,4,5];
        
        foreach ($checklists as $i => $cases) {
            foreach ($cases as $j => $question) {
                $q = Question::create([
                    'number' => $question['number'],
                    'body' => $question['body'],
                    'answer_type' => $question['answer_type'],
                    'level_id' => $i + 2,
                    'score' => $question['score'],
                    'case_study_id' => Level::find(($i + 2))->case_studies()->where('number', ($j + 1))->first()->id,
                ]);

                foreach ($question['checklists'] as $k => $checklist) {
                    Checklist::create([
                        'body' => $checklist['body'],
                        'answer' => $cl_answers[array_rand($cl_answers)],
                        'question_id' => $q->id,
                    ]);
                }
            }
        }

        $essays = [
            [
                [
                    'number' => 2,
                    'body' => '<p>Donec a libero malesuada, lacinia nisi non, elementum lacus. Phasellus eu elit tortor. Duis accumsan nisi urna, sit amet molestie erat sagittis ullamcorper. Maecenas dui orci, aliquam eget ligula sit.</p>',
                    'answer_type' => 'ESSAY',
                    'score' => 3,
                    'essay' => 'Nam lobortis congue orci, vitae vulputate nisi placerat sit amet.',
                ],
                [
                    'number' => 2,
                    'body' => '<p>Sed et massa eget ante rutrum semper. Aenean ornare rhoncus risus, eget vehicula leo finibus sit amet. Donec quis ex pretium enim dignissim laoreet eu eu quam. Aenean tortor est.</p>',
                    'answer_type' => 'ESSAY',
                    'score' => 7,
                    'essay' => 'Sed et erat lorem. Pellentesque habitant morbi tristique senectus et.',
                ],
            ],
            [
                [
                    'number' => 2,
                    'body' => '<p>In mattis venenatis justo id tincidunt. Phasellus tristique, urna sed placerat condimentum, urna metus pellentesque ex, euismod mollis felis justo sollicitudin sem. Quisque in molestie dui, quis finibus massa. Lorem.</p>',
                    'answer_type' => 'ESSAY',
                    'score' => 8,
                    'essay' => 'Nam luctus leo eros, quis egestas ipsum maximus eget. Vivamus.',
                ],
                [
                    'number' => 2,
                    'body' => '<p>Suspendisse eleifend nisi libero, sit amet tincidunt nisl blandit a. Aliquam erat volutpat. Sed ac tellus gravida, gravida turpis in, posuere tellus. Sed euismod purus non dapibus commodo. Etiam fermentum.</p>',
                    'answer_type' => 'ESSAY',
                    'score' => 6,
                    'essay' => 'Etiam et massa et nunc cursus laoreet sit amet sit.',
                ],
            ],
        ];

        foreach ($essays as $i => $cases) {
            foreach ($cases as $j => $question) {
                Question::create([
                    'number' => $question['number'],
                    'body' => $question['body'],
                    'answer_type' => $question['answer_type'],
                    'essay' => $question['essay'],
                    'score' => $question['score'],
                    'level_id' => $i + 2,
                    'case_study_id' => Level::find(($i + 2))->case_studies()->where('number', ($j + 1))->first()->id,
                ]);
            }
        }

        $evaluations = [
            [
                [
                    'body' => 'Donec malesuada nisi vitae nisl cursus, quis faucibus est malesuada.',
                ],
                [
                    'body' => 'Aenean ultricies ipsum id posuere pretium.',
                ],
                [
                    'body' => 'Etiam efficitur justo a luctus aliquet.',
                ],
                [
                    'body' => 'Nulla tincidunt ligula condimentum dolor porta, placerat consequat arcu imperdiet.',
                ],
                [
                    'body' => 'Cras ac quam at erat pulvinar bibendum.',
                ],
                [
                    'body' => 'Aenean consectetur felis at nunc feugiat, non aliquet leo varius.',
                ],
            ],
            [
                [
                    'body' => 'Donec ultrices tortor ut magna dapibus maximus vitae quis ex.',
                ],
                [
                    'body' => 'Fusce nec quam vitae diam placerat bibendum non a justo.',
                ],
                [
                    'body' => 'Nunc eget libero sit amet orci viverra vestibulum.',
                ],
                [
                    'body' => 'Curabitur ornare purus in dictum suscipit.',
                ],
                [
                    'body' => 'Mauris fringilla tellus sed leo rutrum eleifend.',
                ],
                [
                    'body' => 'Ut maximus turpis malesuada, sodales velit eu, blandit urna.',
                ],
            ],
            [
                [
                    'body' => 'Vivamus vitae mi in quam gravida consectetur.',
                ],
                [
                    'body' => 'Aenean semper nisl aliquam, pharetra sem at, consequat risus.',
                ],
                [
                    'body' => 'In a urna at quam tincidunt cursus.',
                ],
                [
                    'body' => 'Aenean vulputate neque euismod, scelerisque dui non, tempus nisi.',
                ],
                [
                    'body' => 'Proin vitae nibh eu tortor efficitur porttitor lobortis sit amet elit.',
                ],
                [
                    'body' => 'Nunc et orci feugiat orci euismod blandit nec ut arcu.',
                ],
            ],
            [
                [
                    'body' => 'Donec tempus nunc sed lobortis molestie.',
                ],
                [
                    'body' => 'Mauris eleifend dolor id ligula eleifend rhoncus.',
                ],
                [
                    'body' => 'Proin ullamcorper ante vel libero laoreet viverra.',
                ],
                [
                    'body' => 'Integer suscipit purus eleifend purus efficitur dignissim.',
                ],
                [
                    'body' => 'Fusce quis augue vitae diam tempus consectetur.',
                ],
                [
                    'body' => 'Vestibulum congue diam eget augue pretium, id vulputate nulla rutrum.',
                ],
            ],
        ];

        foreach ($evaluations as $i => $evals) {
            foreach ($evals as $j => $eval) {
                Evaluation::create([
                    'number' => ($j + 1),
                    'body' => $eval['body'],
                    'level_id' => ($i + 1),
                ]);
            }
        }
    }
}
