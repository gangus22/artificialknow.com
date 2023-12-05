import React, { memo } from "react";
import {
    CpuChipIcon,
    DocumentTextIcon,
    LightBulbIcon,
    QuestionMarkCircleIcon,
} from "@heroicons/react/24/outline";
import { PageWrapper } from "../components/PageWrapper/blocks/PageWrapper";
import { MainPageCard } from "../components/MainPageCard/blocks/MainPageCard";
import { MainPageListitem } from "../components/MainPageListItem/blocks/MainPageListitem";

export const MainPage: React.FC = () => (
    <PageWrapper>
        <div className="mb-5 flex h-full items-center justify-around rounded-xl bg-slate-50 p-2 md:h-96">
            <div className="text-center text-4xl font-black leading-snug md:text-left md:text-6xl">
                Your one-stop shop for <br />
                <span className="bg-gradient-to-br bg-clip-text text-transparent from-primary-600 via-primary-300 to-primary-500">
                    AI knowledge!
                </span>
            </div>
            <div className="hidden md:block">
                <CpuChipIcon className="h-80 w-80 rotate-3 stroke-primary-400" />
            </div>
        </div>
        <div className="flex flex-col">
            <div className="mb-8 text-center text-2xl md:text-3xl font-black md:text-right">
                Dive into articles written with{" "}
                <span className="text-secondary-400">passion</span> and{" "}
                <span className="text-secondary-400">expertise</span>.
            </div>
            <div className="flex flex-col justify-around gap-y-4 md:flex-row">
                <MainPageCard
                    iconComponent={
                        <QuestionMarkCircleIcon className="h-16 w-16 shrink-0 stroke-2 stroke-secondary-400" />
                    }
                    text="Answers by enthusiasts, for enthusiasts"
                />
                <MainPageCard
                    iconComponent={
                        <DocumentTextIcon className="h-16 w-16 shrink-0 stroke-2 stroke-secondary-400" />
                    }
                    text="Proper research, backed with experience"
                />
                <MainPageCard
                    iconComponent={
                        <LightBulbIcon className="h-16 w-16 shrink-0 stroke-2 stroke-secondary-400" />
                    }
                    text="Practical and relatable"
                />
            </div>
        </div>
        <div className="h-full w-full text-2xl font-semibold leading-loose flex justify-center bg-slate-50 rounded-lg p-4">
            <ul className="list-disc list-inside">
                <MainPageListitem
                    href="/ai-tools/chatgpt"
                    text="Our ChatGPT Guides"
                />
                <MainPageListitem
                    href="/ai-tools/deepl"
                    text="Our DeepL Guides"
                />
                <MainPageListitem
                    href="/ai-tools/midjourney"
                    text="Our Midjourney Guides"
                />
            </ul>
        </div>
    </PageWrapper>
);

export default memo(MainPage);
