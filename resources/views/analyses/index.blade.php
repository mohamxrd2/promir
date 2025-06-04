@extends('layouts.master')
@section('content')
<style>
    /* Cacher les barres de défilement dans tous les navigateurs */
.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;     /* Firefox */
}

</style>
    <div class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
        <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
            <div class="flex justify-center items-center mb-2 mt-2">
                <h1 class="flex justify-center items-center text-black text-5xl">
                    <i class="ri-bar-chart-2-line mr-2 text-blue-600"></i>
                    Analyse des Ratios Financiers
                </h1>
            </div>  
                <div class="col-span-12 card 2xl:col-span-12">
                    <div class="card-body">
                        <div class="grid gap-4 mb-5 grid-cols-1 2xl:grid-cols-12 items-start">
                            <!-- Selection -->
                            <div class="relative grow mb-2">
                                <div class="flex justify-end">
                                    <select name="ratio" id="ratio"
                                        class="type select_ratio_filtre form-select w-auto min-w-[200px] max-w-xs px-3 py-2 text-sm border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-custom-500 focus:border-transparent dark:border-zink-500 dark:bg-zink-700 dark:text-zink-100 mr-2">
                                        <option value="" selected>--Selectionnez un ratio--</option>
                                        <option value="ratioDeSolvabiliteGenerale">Ratio de solvabilité géneral </option>
                                        <option value="ratioDeAutonomieFinanciere">Ratio d'independance financière </option>
                                        <option value="ratioDeLiquiditeGenerale">Ratio de liquidité générale</option>
                                    </select>


                                    
                                    <select name="periode_analyse" id="periode_analyse"
                                         class="type form-select w-auto min-w-[200px] max-w-xs px-3 py-2 text-sm border border-slate-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-custom-500 focus:border-transparent dark:border-zink-500 dark:bg-zink-700 dark:text-zink-100 mr-2">
                                        <option value="" selected>--Période d'analyse--</option>
                                        <option value="1">Le dernier mois</option>
                                        <option value="2">Les deux derniers mois</option>
                                        <option value="3">Les trois derniers mois</option>
                                    </select>

                                    <button type="button"
                                        class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-all">
                                        <i class="ri-upload-2-line mr-1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                       <div class="flex flex-col gap-4">
                            <!-- Graphe principal en haut -->
                            <div class="border-b-4 pb-4 flex flex-col gap-4">
                                <h2 id="graphTitle" class="text-xl mb-4 text-center"></h2>
                                <div id="graphContainer" class="apex-charts" data-chart-colors='["bg-purple-500", "bg-sky-500"]' dir="ltr"></div>
                                <p id="penteDuGraphe" class="text-center"></p>
                            </div>

                            <!-- Sous-graphes en bas -->
                            <div id="sous-graph-container" class="grid grid-cols-1 sm:grid-cols-2 gap-4 border p-4 rounded-md">
                                <!-- Les sous-graphes seront injectés ici dynamiquement -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>






<script>
  

(() => {
  
  let mainChart = null; // graphe principal
  const graphCurves = ["smooth", "straight"]; 

  function rgbToHex(rgb) {
    const match = rgb.match(/\d+/g);
    if (!match || match.length !== 3) return rgb;
    const [r, g, b] = match.map(Number);
    return (
      "#" +
      r.toString(16).padStart(2, "0") +
      g.toString(16).padStart(2, "0") +
      b.toString(16).padStart(2, "0")
    ).toUpperCase();
  }

  /**
   * Récupère le tableau des couleurs hexadécimales pour un conteneur.
   */
  function getChartColorsArray(containerId) {
    const el = document.getElementById(containerId);
    if (!el) return [];

    const raw = el.dataset.chartColors;
    if (!raw) return [];

    try {
      return JSON.parse(raw).map((value) => {
        const cleaned = value.replace(/\s/g, "");
        if (cleaned.startsWith("#")) return cleaned; // déjà hex

        // sinon : c’est un sélecteur (classe Tailwind p.ex.)
        const probe = document.createElement("div");
        probe.className = cleaned;
        document.body.appendChild(probe);
        const col = rgbToHex(getComputedStyle(probe).backgroundColor);
        document.body.removeChild(probe);
        return col;
      });
    } catch (_) {
      console.warn("Impossible de parser data-chart-colors pour", containerId);
      return [];
    }
  }

  /**
   * Régression linéaire simple (y = ax + b)
   * Retourne {tendance: number[], pente: number}
   */
  function calculerTendance(valeurs) {
    const n = valeurs.length;
    if (!n) return { tendance: [], pente: 0 };

    let sumX = 0,
      sumY = 0,
      sumXY = 0,
      sumXX = 0;

    for (let i = 0; i < n; i++) {
      sumX += i;
      sumY += valeurs[i];
      sumXY += i * valeurs[i];
      sumXX += i * i;
    }

    const denom = n * sumXX - sumX * sumX || 1; // évite /0
    const a = (n * sumXY - sumX * sumY) / denom;
    const b = (sumY - a * sumX) / n;

    return {
      tendance: Array.from({ length: n }, (_, i) => +(a * i + b).toFixed(4)),
      pente: +a.toFixed(5),
    };
  }



  /* ----------------------------------------------------------
   *  Références DOM et utils UI
   * ---------------------------------------------------------- */
  const selectRatio = document.getElementById("ratio");
  const periodeInput = document.getElementById("periode_analyse");
  const sousGraphWrapper = document.getElementById("sous-graph-container");

  const libelles = {
  ratioDeSolvabiliteGenerale: "Ratio de solvabilité générale",
  creanceClients:             "Créances clients",
  matierePremiere:            "Matières premières",
  disponiblites:              "Disponibilités",        // (orthographe d'origine conservée)
  produitsFinis:              "Produits finis",
  avancesEtAcompte:           "Avances et acomptes",
  dettesFournisseurs:         "Dettes fournisseurs",
  dettesSocialesEtFiscales:   "Dettes sociales et fiscales",
  autresDettesFinancieres:    "Autres dettes financières",
  dettesSurImmobilisations:   "Dettes sur immobilisations"
};

  const ratioLabels = {
    ratioDeSolvabiliteGenerale: "Ratio de solvabilité générale",
    ratioDeAutonomieFinanciere: "Ratio d'indépendance financière",
    ratioDeLiquiditeGenerale: "Ratio de liquidité générale",
  };

  function setSelectState(state) {
    if (state === "disable") {
      selectRatio.disabled = true;
      selectRatio.classList.add("opacity-50");
      selectRatio.style.cursor = "progress";
    } else {
      selectRatio.disabled = false;
      selectRatio.classList.remove("opacity-50");
      selectRatio.style.cursor = "pointer";
    }
  }

  function clearSousGraphs() {
    sousGraphWrapper.innerHTML = ""; // reset
  }

  /**
   * Crée et rend un graphique ApexCharts dans le conteneur donné.
   */
  function createLineChart(container, variableData, trendData, curve, grahName) {
    const colors = getChartColorsArray(container.id);

    const chart = new ApexCharts(container, {
      series: [
        { name: grahName, data: variableData },
        { name: "Tendance", data: trendData },
      ],
      chart: {
        type: "line",
        height: 400,
        zoom: { enabled: true },
        toolbar: { show: true },
      },
      stroke: { 
        curve,
        width: 2 },
      xaxis: {
        type: "datetime",
        labels: { format: "dd/MM", rotate: -45 },
      },
      colors,
      dataLabels: { enabled: false },
      grid: { show: true, padding: { top: -20, right: 0 } },
      markers: { hover: { sizeOffset: 5 } },
    });

    chart.render();
    return chart;
  }

  /* ----------------------------------------------------------
   *  Événement principal sur le <select>
   * ---------------------------------------------------------- */
  selectRatio.addEventListener("change", () => {
    const ratio = selectRatio.value;
    if (!ratioLabels[ratio]) {
      toastr.info("Ratio invalide !");
      document.getElementById("graphTitle").innerText = "Sélectionnez un ratio valide";
      return;
    }

    document.getElementById("graphTitle").innerText = ratioLabels[ratio];
    tracerGraph(ratio);
  });

  /* ----------------------------------------------------------
   *  Fonction principale : tracerGraph
   * ---------------------------------------------------------- */
  function tracerGraph(ratio) {
    const periode = periodeInput.value;
    if (!periode) {
      toastr.info("Veuillez sélectionner une période d'analyse.");
      return;
    }

    setSelectState("disable");
    clearSousGraphs();

    fetch("/graph_data", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": document
          .querySelector('meta[name="csrf-token"]').getAttribute("content"),
      },
      body: JSON.stringify({ ratio, periode }),
    })
      .then((res) => {
        if (!res.ok) throw new Error("Échec de la requête");
        return res.json();
      })
      .then((raw) => {

        const keys = Object.keys(raw);
        const dataArray = Array.isArray(raw) ? raw : Object.values(raw);
        if (!dataArray.length) throw new Error("Aucune donnée retournée");

        dataArray.forEach((element, idx) => {
          const dates = Object.keys(element);
          const values = Object.values(element);

          const variableData = dates.map((d, i) => ({ x: new Date(d), y: values[i] }));
          const { tendance, pente } = calculerTendance(values);
          const trendData = dates.map((d, i) => ({ x: new Date(d), y: tendance[i] }));

          if (idx === 0) {
            document.getElementById("penteDuGraphe").innerText = `Pente : ${pente}`;
            if (mainChart) mainChart.destroy();
            mainChart = createLineChart(
              document.getElementById("graphContainer"),
              variableData,
              trendData,
              graphCurves[0], libelles[keys[0]]
            );
          } else {
            const sub = document.createElement("div");
            sub.id = `sousgraph${idx}`;
            sub.className = "apex-charts border p-2 rounded-md bg-white shadow";
            sub.dataset.chartColors = '["bg-purple-500","bg-sky-500"]';
            sub.dir = "ltr";
            sousGraphWrapper.appendChild(sub);
            libelles[keys[0]]
            const subTitle = document.createElement("h3");
            subTitle.className = "text-lg mb-2 text-center";
            subTitle.innerText = "Evolution des "+libelles[keys[idx]];
            sub.appendChild(subTitle);
            createLineChart(sub, variableData, trendData, graphCurves[1], libelles[keys[idx]]);
            const subPente = document.createElement("p");
            subPente.className = "text-center mb-2";
            subPente.innerText = `Pente : ${pente}`;
            sub.appendChild(subPente);
          }
        });
      })
      .catch((err) => {
        console.error("Erreur fetch graph_data :", err);
        toastr.error("Erreur de connexion. Veuillez réessayer.");
      })
      .finally(() => setSelectState("enable"));
  }
})();

</script>


@endsection